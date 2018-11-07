<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

class CustomerTests extends TestCase
{
    public $strype;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
    }

    public function testCreateCustomer()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $this->assertEquals($customer->getId(), $customer->getResponse()->id);
        $this->assertFalse($customer->getResponse()->livemode);
        $customer->getResponse()->delete();
    }

    public function testCreateCustomerWithIdempotentRequest()
    {
        $id = new ObjectId();

        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard', [], $id->get(12));
        $this->assertEquals($customer->getId(), $customer->getResponse()->id);
        $this->assertFalse($customer->getResponse()->livemode);
        $this->assertEquals('levi@example.com', $customer->email);
        $customer->getResponse()->delete();
    }

    public function testRetrieveCustomer()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $retrieved = $this->strype->customer()->retrieve($customer->getId());
        $this->assertEquals($customer->email, $retrieved->email);
        $this->assertEquals($customer->invoice_prefix, $retrieved->invoice_prefix);
        $this->assertEquals($customer->created, $retrieved->created);
        $retrieved->getResponse()->delete();
    }

    public function testUpdateCustomer()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $retrieved = $this->strype->customer()->retrieve($customer->getId());
        $retrieved->getResponse()->email = 'evil@example.com';
        $retrieved->getResponse()->save();
        $cu = $this->strype->customer()->retrieve($customer->getId());
        $this->assertEquals('evil@example.com', $cu->email);
        $retrieved->getResponse()->delete();
    }

    public function testDeleteCustomer()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $retrieved = $this->strype->customer()->retrieve($customer->getId());
        $response = $retrieved->getResponse()->delete();
        $this->assertEquals($customer->getId(), $response->id);
        $this->assertTrue($response->deleted);
    }

    public function testListAllCustomers()
    {
        $customers = $this->strype->customer()->listAll(['limit' => 3]);
        $this->assertEquals(3, count($customers->getResponse()->data));
    }

    public function testGetCustomerId()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $this->assertEquals($customer->getCustomerId(), $customer->getResponse()->id);
        $this->assertFalse($customer->getResponse()->livemode);
        $customer->getResponse()->delete();
    }
}
