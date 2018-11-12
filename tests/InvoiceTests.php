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
        $invoiceItem = $this->strype->invoiceItem()->create($this->customer,
            new \Bulldog\Strype\Resources\InvoiceItems\Amount(2500)
        );
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Resources\Subscriptions\ChargeAutomatically()
        );
        $this->assertEquals('invoice', $invoice->object);
        $this->assertEquals($this->customer->getCustomerId(), $invoice->customer);
        $this->assertEquals(2500, $invoice->total);
    }

    public function testCreateInvoiceAndSend()
    {
        $invoiceItem = $this->strype->invoiceItem()->create($this->customer,
            new \Bulldog\Strype\Resources\InvoiceItems\Amount(2500)
        );
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Resources\Subscriptions\SendInvoice(30)
        );
        $this->assertEquals('invoice', $invoice->object);
        $this->assertEquals($this->customer->getCustomerId(), $invoice->customer);
        $this->assertEquals(2500, $invoice->total);
    }

    public function testRetrieveInvoice()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Resources\Subscriptions\SendInvoice(30)
        );
        $retrieved = $this->strype->invoice()->retrieve($invoice->id);
        $this->assertEquals('invoice', $retrieved->object);
        $this->assertEquals($this->customer->getCustomerId(), $retrieved->customer);
        $this->assertEquals(2500, $retrieved->total);
    }

    public function tearDown()
    {
        $this->customer->getResponse()->delete();
    }
}
