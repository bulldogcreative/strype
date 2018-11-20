<?php

namespace Strype;

class BalanceTest extends TestCase
{
    const TEST_RESOURCE_ID = 'txn_123';

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/v1/balance'
        );

        $resource = $this->strype->balance()->retrieve()->getResponse();
        $this->assertInstanceOf("Stripe\\Balance", $resource);
        $this->assertFalse($resource->livemode);
        $this->assertEquals('balance', $resource->object);
    }

    public function testRetrieveBalanceTransaction()
    {
        $this->expectsRequest(
            'get',
            '/v1/balance/history/' . self::TEST_RESOURCE_ID
        );

        $balance = $this->strype->balance()->retrieveBalanceTransaction(self::TEST_RESOURCE_ID);
        $this->assertEquals(100, $balance->amount);
        $this->assertInstanceOf("Stripe\\BalanceTransaction", $balance->getResponse());
    }
}
