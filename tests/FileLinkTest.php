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

    public function testRetrieveLink()
    {
        $this->expectsRequest(
            'get',
            '/v1/file_links/' . self::TEST_RESOURCE_ID
        );

        $link = $this->strype->fileLink()->retrieve(self::TEST_RESOURCE_ID);
        $this->assertEquals('file_link', $link->object);
        $this->assertInstanceOf("Stripe\\FileLink", $link->getResponse());
    }

    public function testUpdateLink()
    {
        $this->expectsRequest(
            'get',
            '/v1/file_links/' . self::TEST_RESOURCE_ID
        );

        $link = $this->strype->fileLink()->update(self::TEST_RESOURCE_ID, [
            "metadata" => ["key" => "value"],
        ]);
        $this->assertEquals('file_link', $link->object);
        $this->assertInstanceOf("Stripe\\FileLink", $link->getResponse());
    }

    // public function testListAll()
    // {
    //     $all = $this->strype->fileLink()->listAll(['limit' => 1]);
    //     $this->assertEquals(1, count($all->data));
    // }
}
