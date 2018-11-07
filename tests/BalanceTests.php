<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

class BalanceTests extends TestCase
{
    public $strype;
    public $id;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
        $this->id = new ObjectId();
    }

    public function testRetrieveBalance()
    {
        $balance = $this->strype->balance()->retrieveBalance();
        $this->assertFalse($balance->getResponse()->livemode);
        $this->assertEquals('balance', $balance->object);
    }

    public function testRetrieveBalanceTransaction()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_visa', [], $this->id->get(12));
        $charge = $this->strype->charge()->create($customer, 50, [], $this->id->get(12));
        $balance = $this->strype->balance()->retrieve($charge->balance_transaction);
        $this->assertEquals(50, $balance->amount);
    }
}
