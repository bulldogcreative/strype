<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

class ChargeTests extends TestCase
{
    public $strype;
    public $customer;
    public $id;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
        $this->customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $this->id = new ObjectId();
    }

    public function testCreateCharge()
    {
        $id = new ObjectId();
        $charge = $this->strype->chargeCustomer($this->customer, 5000, [], $id->get(12));
        $this->assertEquals(5000, $charge->amount);
        $this->assertEquals($this->customer->getCustomerId(), $charge->customer);
    }

    public function testRetrieveCharge()
    {
        $id = new ObjectId();
        $charge = $this->strype->chargeCustomer($this->customer, 5000, [], $id->get(12));
        $retrieved = $this->strype->charge()->retrieve($charge->getId());
        $this->assertEquals($charge->balance_transaction, $retrieved->getResponse()->balance_transaction);
    }

    public function testUpdateCharge()
    {
        $id = new ObjectId();
        $charge = $this->strype->chargeCustomer($this->customer, 5000, [], $id->get(12));
        $retrieved = $this->strype->charge()->retrieve($charge->getId());
        $retrieved->getResponse()->description = 'New Description';
        $retrieved->getResponse()->save();
        $ch = $this->strype->charge()->retrieve($charge->getId());
        $this->assertEquals('New Description', $ch->description);
    }

    public function testCaptureCharge()
    {
        $charge = $this->strype->charge()->create($this->customer, 5000, [
            'capture' => false,
        ], $this->id->get(12));
        $retrieved = $this->strype->charge()->retrieve($charge->getId());
        $this->assertFalse($retrieved->captured);
        $retrieved->getResponse()->capture();
        $retrieved = $this->strype->charge()->retrieve($charge->getId());
        $this->assertTrue($retrieved->captured);
    }

    public function testListAllCharges()
    {
        $charges = $this->strype->charge()->listAll(['limit' => 3]);
        $this->assertEquals(3, count($charges->getResponse()->data));
    }

    public function tearDown()
    {
        $this->customer->getResponse()->delete();
    }
}
