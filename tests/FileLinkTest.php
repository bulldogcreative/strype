<?php

namespace Strype;

use Bulldog\Strype\Models\Files\BusinessLogo;

class FileLinkTest extends TestCase
{
    const TEST_RESOURCE_ID = 'link_123';

    public function testCreateLink()
    {
        $this->expectsRequest(
            'post',
            '/v1/file_links'
        );
        $fileLink = $this->strype->fileLink()->create('file_123', [], $this->id->get(12));

        $this->assertEquals('file_link', $fileLink->object);
        $this->assertInstanceOf("Stripe\\FileLink", $fileLink->getResponse());
    }

    // public function testRetrieveLink()
    // {
    //     $fp = fopen('./tests/files/Blank.jpg', 'r');
    //     $logo = new BusinessLogo($fp);
    //     $file = $this->strype->file()->create($logo, [], $this->id->get(12));
    //     $fileLink = $this->strype->fileLink()->create($file->getId(), [], $this->id->get(12));

    //     $link = $this->strype->fileLink()->retrieve($fileLink->getId());
    //     $this->assertEquals($fileLink->url, $link->url);
    // }

    // public function testUpdateLink()
    // {
    //     $fp = fopen('./tests/files/Blank.jpg', 'r');
    //     $logo = new BusinessLogo($fp);
    //     $file = $this->strype->file()->create($logo, [], $this->id->get(12));
    //     $fileLink = $this->strype->fileLink()->create($file->getId(), [], $this->id->get(12));
    //     $link = $this->strype->fileLink()->retrieve($fileLink->getId());

    //     $link->getResponse()->metadata['order_id'] = '6735';
    //     $link->getResponse()->save();

    //     $updated = $this->strype->fileLink()->retrieve($fileLink->getId());
    //     $this->assertEquals('6735', $updated->metadata['order_id']);
    // }

    // public function testListAll()
    // {
    //     $all = $this->strype->fileLink()->listAll(['limit' => 1]);
    //     $this->assertEquals(1, count($all->data));
    // }
}
