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

    public function testCreateInvoiceItemWithAmount()
    {
        $invoiceItem = $this->strype->invoiceItem()->create($this->customer,
            new \Bulldog\Strype\Resources\InvoiceItems\Amount(2500)
        );
        $this->assertEquals('invoiceitem', $invoiceItem->object);
        $this->assertEquals(2500, $invoiceItem->amount);
        $this->assertEquals($this->customer->getId(), $invoiceItem->customer);
        $this->assertEquals('usd', $invoiceItem->currency);
        $this->assertInternalType('int', $invoiceItem->amount);
    }

    public function testCreateInvoiceItemWithQuantity()
    {
        $invoiceItem = $this->strype->invoiceItem()->create($this->customer,
            new \Bulldog\Strype\Resources\InvoiceItems\Quantity(5, 500)
        );
        $this->assertEquals('invoiceitem', $invoiceItem->object);
        $this->assertEquals(2500, $invoiceItem->amount);
        $this->assertEquals($this->customer->getId(), $invoiceItem->customer);
        $this->assertEquals('usd', $invoiceItem->currency);
        $this->assertInternalType('int', $invoiceItem->amount);
    }

    public function testRetrieveInvoiceItem()
    {
        $invoiceItem = $this->strype->invoiceItem()->create($this->customer,
            new \Bulldog\Strype\Resources\InvoiceItems\Amount(2500)
        );
        $retrieved = $this->strype->invoiceItem()->retrieve($invoiceItem->id);
        $this->assertEquals('invoiceitem', $retrieved->object);
        $this->assertEquals(2500, $retrieved->amount);
        $this->assertEquals($this->customer->getId(), $retrieved->customer);
        $this->assertEquals('usd', $retrieved->currency);
        $this->assertInternalType('int', $retrieved->amount);
    }

    public function testUpdateInvoiceItem()
    {
        $invoiceItem = $this->strype->invoiceItem()->create($this->customer,
            new \Bulldog\Strype\Resources\InvoiceItems\Amount(2500)
        );
        $updated = $this->strype->invoiceItem()->update($invoiceItem->id, [
            'amount' => 3500,
        ]);
        $this->assertEquals('invoiceitem', $updated->object);
        $this->assertEquals(3500, $updated->amount);
        $this->assertEquals($this->customer->getId(), $updated->customer);
        $this->assertEquals('usd', $updated->currency);
        $this->assertInternalType('int', $updated->amount);
    }

    public function testDeleteInvoiceItem()
    {
        $invoiceItem = $this->strype->invoiceItem()->create($this->customer,
            new \Bulldog\Strype\Resources\InvoiceItems\Amount(2500)
        );
        $deleted = $this->strype->invoiceItem()->delete($invoiceItem->id);
        $this->assertEquals('invoiceitem', $deleted->object);
        $this->assertTrue($deleted->deleted);
    }

    public function testListAllInvoiceItems()
    {
        $items = $this->strype->invoiceItem()->listAll(['limit' => 3]);
        foreach ($items->data as $item) {
            $this->assertEquals('invoiceitem', $item->object);
        }
        $this->assertCount(3, $items->data);
    }

    public function tearDown()
    {
        $this->customer->getResponse()->delete();
    }
}
