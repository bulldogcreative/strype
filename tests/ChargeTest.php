<?php

namespace Strype;

class ChargeTest extends TestCase
{
    public function testCreateCharge()
    {
        $charge = $this->strype->chargeCustomer($this->customer, 100, [], $this->id->get(12));
        $this->assertEquals(100, $charge->amount);
        $this->assertEquals($this->customer->getId(), 'cus_Dw9uU13WgIF6Q4');
    }

    public function testRetrieveCharge()
    {
        $charge = $this->strype->chargeCustomer($this->customer, 100, [], $this->id->get(12));
        $retrieved = $this->strype->charge()->retrieve($charge->getId());
        $this->assertEquals($charge->balance_transaction, $retrieved->getResponse()->balance_transaction);
    }

    public function testUpdateCharge()
    {
        $charge = $this->strype->chargeCustomer($this->customer, 100, [], $this->id->get(12));
        $retrieved = $this->strype->charge()->retrieve($charge->getId());
        $retrieved->getResponse()->description = 'My First Test Charge (created for API docs)';
        $retrieved->getResponse()->save();
        $ch = $this->strype->charge()->retrieve($charge->getId());
        $this->assertEquals('My First Test Charge (created for API docs)', $ch->description);
    }

    public function testCaptureCharge()
    {
        $charge = $this->strype->charge()->create($this->customer, 100, [
            'capture' => false,
        ], $this->id->get(12));
        $retrieved = $this->strype->charge()->retrieve($charge->getId());
        $this->assertFalse($retrieved->captured);
        $retrieved->capture($charge->getId());

        $retrieved = $this->strype->charge()->retrieve($charge->getId());
        $this->assertFalse($retrieved->captured);

        $charge = $this->strype->charge()->create($this->customer, 100, [
            'capture' => false,
        ], $this->id->get(12));
        $retrieved = $this->strype->charge()->retrieve($charge->getId());
        $this->assertFalse($retrieved->captured);
        $retrieved->capture();
        $retrieved = $this->strype->charge()->retrieve($charge->getId());
        $this->assertFalse($retrieved->captured);
    }

    public function testListAllCharges()
    {
        $charges = $this->strype->charge()->listAll(['limit' => 1]);
        $this->assertEquals(1, count($charges->getResponse()->data));
    }
}
