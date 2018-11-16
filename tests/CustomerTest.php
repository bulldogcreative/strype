<?php

namespace Strype;

class CustomerTest extends TestCase
{
    const TEST_RESOURCE_ID = 'cus_123';
    const TEST_SOURCE_ID = 'ba_123';

    public function testCreateCustomer()
    {
        $this->expectsRequest(
            'post',
            '/v1/customers'
        );
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $this->assertEquals($customer->getId(), $customer->getResponse()->id);
        $this->assertFalse($customer->getResponse()->livemode);
        $customer->getResponse()->delete();
    }

    public function testCreateCustomerWithIdempotentRequest()
    {
        $this->expectsRequest(
            'post',
            '/v1/customers'
        );
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard', [], $this->id->get(12));
        $this->assertEquals($customer->getId(), $customer->getResponse()->id);
        $this->assertFalse($customer->getResponse()->livemode);
        $customer->getResponse()->delete();
    }

    public function testRetrieveCustomer()
    {
        $this->expectsRequest(
            'post',
            '/v1/customers'
        );
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $retrieved = $this->strype->customer()->retrieve($customer->getId());
        $this->assertEquals($customer->email, $retrieved->email);
        $this->assertEquals($customer->invoice_prefix, $retrieved->invoice_prefix);
        $this->assertEquals($customer->created, $retrieved->created);
    }

    public function testUpdateCustomer()
    {
        $resource = $this->strype->customer()->update(self::TEST_RESOURCE_ID, [
            'metadata' => [
                'key' => 'value',
            ]
        ]);
        $this->assertInstanceOf("Stripe\\Customer", $resource->getResponse());
    }

    public function testDeleteCustomer()
    {
        $resource = $this->strype->customer()->retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/v1/customers/' . $resource->id
        );
        $resource = $resource->getResponse()->delete();
        $this->assertEquals(self::TEST_RESOURCE_ID, $resource->id);
        $this->assertTrue($resource->deleted);
    }

    public function testListAllCustomers()
    {
        $this->expectsRequest(
            'get',
            '/v1/customers'
        );
        $customers = $this->strype->customer()->listAll(['limit' => 1]);
        $this->assertEquals(1, count($customers->getResponse()->data));
    }

    public function testgetId()
    {
        $this->expectsRequest(
            'post',
            '/v1/customers'
        );
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $this->assertEquals($customer->getId(), $customer->getResponse()->id);
        $this->assertFalse($customer->getResponse()->livemode);
    }
}
