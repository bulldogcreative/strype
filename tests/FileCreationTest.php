<?php

namespace Strype;

use Bulldog\Strype\Models\Files\BusinessLogo;

class FileCreationTest extends TestCase
{
    /**
     * @before
     */
    public function setUpUploadBase()
    {
        \Stripe\Stripe::$apiUploadBase = \Stripe\Stripe::$apiBase;
        \Stripe\Stripe::$apiBase = null;
    }

    /**
     * @after
     */
    public function tearDownUploadBase()
    {
        \Stripe\Stripe::$apiBase = \Stripe\Stripe::$apiUploadBase;
        \Stripe\Stripe::$apiUploadBase = 'https://files.stripe.com';
    }

    public function testIsCreatableWithFileHandle()
    {
        $this->expectsRequest(
            'post',
            '/v1/files',
            null,
            ['Content-Type: multipart/form-data'],
            true,
            \Stripe\Stripe::$apiUploadBase
        );
        $fp = fopen('./tests/files/Blank.jpg', 'r');
        $logo = new BusinessLogo($fp);

        $resource = $this->strype->file()->create($logo)->getResponse();
        $this->assertInstanceOf("Stripe\\File", $resource);
    }

    // public function testIsCreatableWithCurlFile()
    // {
    //     if (!class_exists('\CurlFile', false)) {
    //         // Older PHP versions don't support this
    //         return;
    //     }

    //     $this->expectsRequest(
    //         'post',
    //         '/v1/files',
    //         null,
    //         ['Content-Type: multipart/form-data'],
    //         true,
    //         \Stripe\Stripe::$apiUploadBase
    //     );
    //     $curlFile = new \CurlFile(dirname(__FILE__) . '/../data/test.png');
    //     $resource = File::create([
    //         "purpose" => "dispute_evidence",
    //         "file" => $curlFile,
    //     ]);
    //     $this->assertInstanceOf("Stripe\\File", $resource);
    // }
}
