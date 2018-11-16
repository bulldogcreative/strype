<?php

namespace Strype;

class RefundTest extends TestCase
{
    public function testCreateRefund()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_visa', [], $this->id->get(12));
        $charge = $this->strype->charge()->create($customer, 50, [], $this->id->get(12));
        $refund = $this->strype->refund()->create($charge, [], $this->id->get(12));
        $this->assertEquals('refund', $refund->object);
        $this->assertEquals('succeeded', $refund->status);
        $this->assertEquals($charge->getId(), $refund->charge);
        $this->assertInstanceOf("Stripe\\Refund", $refund->getResponse());
    }

    public function testRetrieveRefund()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_visa', [], $this->id->get(12));
        $charge = $this->strype->charge()->create($customer, 50, [], $this->id->get(12));
        $refund = $this->strype->refund()->create($charge, [], $this->id->get(12));
        $retrieved = $this->strype->refund()->retrieve($refund->getId());
        $this->assertEquals($refund->getId(), $retrieved->getId());
        $this->assertEquals($refund->charge, $retrieved->charge);
        $this->assertInstanceOf("Stripe\\Refund", $retrieved->getResponse());
    }

    public function testUpdateRefund()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_visa', [], $this->id->get(12));
        $charge = $this->strype->charge()->create($customer, 50, [], $this->id->get(12));
        $refund = $this->strype->refund()->create($charge, [], $this->id->get(12));
        $this->strype->refund()->update($refund->getId(), ['metadata' => ['order_id' => '6735']]);
        $retrieved = $this->strype->refund()->retrieve($refund->getId());
        $this->assertInstanceOf("Stripe\\Refund", $retrieved->getResponse());
    }

    public function testListAllRefunds()
    {
        $refunds = $this->strype->refund()->listAll(['limit' => 1]);
        $this->assertEquals(1, count($refunds->data));
    }
}
