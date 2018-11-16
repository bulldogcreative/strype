<?php

namespace Strype;

class PayoutTest extends TestCase
{
    const TEST_RESOURCE_ID = 'po_123';

    public function testCreatePayout()
    {
        $this->expectsRequest(
            'post',
            '/v1/payouts'
        );
        $resource = $this->strype->payout()->create(500);

        $this->assertEquals('payout', $resource->object);
        $this->assertInstanceOf("Stripe\\Payout", $resource->getResponse());
    }

    public function testListAllAndRetrievePayouts()
    {
        $this->expectsRequest(
            'get',
            '/v1/payouts'
        );
        $resources = $this->strype->payout()->listAll();

        $this->assertEquals('payout', $resources->data[0]->object);
        $this->assertInstanceOf("Stripe\\Payout", $resources->data[0]);
    }

    public function testUpdatePayout()
    {
        // It has to get the object before it can do anything else.
        // This will change after #20
        $this->expectsRequest(
            'get',
            '/v1/payouts/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->strype->payout()->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['order_id' => 6735]
        ]);
        $this->assertEquals('payout', $resource->object);
        $this->assertInstanceOf("Stripe\\Payout", $resource->getResponse());
    }

    public function testCancelPayout()
    {
        // It has to get the object before it can do anything else.
        // This will change after #20
        $this->expectsRequest(
            'get',
            '/v1/payouts/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->strype->payout()->cancel(self::TEST_RESOURCE_ID);
        $this->assertInstanceOf("Stripe\\Payout", $resource->getResponse());
    }
}
