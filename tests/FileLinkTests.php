<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\Strype\Models\Files\BusinessLogo;
use Bulldog\id\ObjectId;

class FileLinkTests extends TestCase
{
    public $strype;
    public $id;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
        $this->id = new ObjectId();
    }

    public function testCreateLink()
    {
        $fp = fopen('./tests/files/Blank.jpg', 'r');
        $logo = new BusinessLogo($fp);
        $file = $this->strype->file()->create($logo, [], $this->id->get(12));
        $fileLink = $this->strype->fileLink()->create($file->getId(), [], $this->id->get(12));

        $this->assertEquals($file->getId(), $fileLink->file);
        $this->assertEquals('file_link', $fileLink->object);
    }

    public function testRetrieveLink()
    {
        $fp = fopen('./tests/files/Blank.jpg', 'r');
        $logo = new BusinessLogo($fp);
        $file = $this->strype->file()->create($logo, [], $this->id->get(12));
        $fileLink = $this->strype->fileLink()->create($file->getId(), [], $this->id->get(12));

        $link = $this->strype->fileLink()->retrieve($fileLink->getId());
        $this->assertEquals($fileLink->url, $link->url);
    }

    public function testUpdateLink()
    {
        $fp = fopen('./tests/files/Blank.jpg', 'r');
        $logo = new BusinessLogo($fp);
        $file = $this->strype->file()->create($logo, [], $this->id->get(12));
        $fileLink = $this->strype->fileLink()->create($file->getId(), [], $this->id->get(12));
        $link = $this->strype->fileLink()->retrieve($fileLink->getId());

        $link->getResponse()->metadata['order_id'] = '6735';
        $link->getResponse()->save();

        $updated = $this->strype->fileLink()->retrieve($fileLink->getId());
        $this->assertEquals('6735', $updated->metadata['order_id']);
    }

    public function testListAll()
    {
        $all = $this->strype->fileLink()->listAll(['limit' => 3]);
        $this->assertEquals(3, count($all->data));
    }
}
