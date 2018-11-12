<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

class InvoiceItemTests extends TestCase
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

    public function testCreateInvoiceItem()
    {
        $invoiceItem = $this->strype->invoiceItem()->create($this->customer);
        $this->assertEquals('invoiceitem', $invoiceItem->object);
    }

    public function tearDown()
    {
        $this->customer->getResponse()->delete();
    }
}
