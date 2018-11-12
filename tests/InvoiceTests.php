<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

class InvoiceTests extends TestCase
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

    public function testCreateInvoiceAndChargeAutomatically()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Resources\Subscriptions\ChargeAutomatically()
        );
        dump($invoice);
    }

    public function tearDown()
    {
        $this->customer->getResponse()->delete();
    }
}
