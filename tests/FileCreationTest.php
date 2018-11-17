<?php

namespace Strype;

use Bulldog\Strype\Models\Files\BusinessLogo;

class FileCreationTest extends TestCase
{
    public function testIsCreatableWithFileHandle()
    {
        \Stripe\Stripe::setApiKey(getenv('STRIPE_API_KEY'));
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
}
