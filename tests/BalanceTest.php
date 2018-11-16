<?php

namespace Stripe;

use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

class BalanceTest extends TestCase
{
    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/v1/balance'
        );
        $resource = $this->strype->balance()->retrieveBalance()->getResponse();
        $this->assertInstanceOf("Stripe\\Balance", $resource);
        $this->assertFalse($resource->livemode);
        $this->assertEquals('balance', $resource->object);
    }
}