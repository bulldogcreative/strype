<?php

namespace Strype;

class ChargeTest extends TestCase
{
    const TEST_RESOURCE_ID = 'ch_123';

    public function testCreateCharge()
    {
        $this->expectsRequest(
            'post',
            '/v1/charges'
        );
        $charge = $this->strype->charge()->create($this->customer, 100, [], $this->id->get(12));
        $this->assertEquals(100, $charge->amount);
    }

    public function testRetrieveCharge()
    {
        $this->expectsRequest(
            'get',
            '/v1/charges/' . self::TEST_RESOURCE_ID
        );

        $retrieved = $this->strype->charge()->retrieve('ch_123');
        $this->assertInstanceOf("Stripe\\Charge", $retrieved->getResponse());
    }

    public function testUpdateCharge()
    {
        $this->expectsRequest(
            'get',
            '/v1/charges/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->strype->charge()->update(self::TEST_RESOURCE_ID, [
            'metadata' => [
                'key' => 'value',
            ]
        ]);

        $this->assertEquals('My First Test Charge (created for API docs)', $resource->description);
        $this->assertInstanceOf("Stripe\\Charge", $resource->getResponse());
    }

    public function testCaptureCharge()
    {
        $resource = $this->strype->charge()->capture(self::TEST_RESOURCE_ID);
        $this->assertEquals('succeeded', $resource->status);
        $this->assertInstanceOf("Stripe\\Charge", $resource->getResponse());
    }

    public function testListAllCharges()
    {
        $this->expectsRequest(
            'get',
            '/v1/charges'
        );
        $resource = $this->strype->charge()->listAll(['limit' => 1]);
        $this->assertTrue(is_array($resource->data));
        $this->assertEquals(1, count($resource->getResponse()->data));
        $this->assertInstanceOf("Stripe\\Charge", $resource->getResponse()->data[0]);
    }
}
