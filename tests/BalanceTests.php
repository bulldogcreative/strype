<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;

class BalanceTests extends TestCase
{
    public $strype;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
    }

    public function testRetrieveBalance()
    {
        $balance = $this->strype->balance()->retrieveBalance();
        $this->assertFalse($balance->getResponse()->livemode);
        $this->assertEquals('balance', $balance->object);
    }
}
