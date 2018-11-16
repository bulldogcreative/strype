<?php

namespace Strype;

class InvoiceItemTest extends TestCase
{
    public function testCreateInvoiceItemWithAmount()
    {
        $invoiceItem = $this->strype->invoiceItem()->create($this->customer,
            new \Bulldog\Strype\Models\InvoiceItems\Amount(1000)
        );
        $this->assertEquals('invoiceitem', $invoiceItem->object);
        $this->assertEquals(1000, $invoiceItem->amount);
        $this->assertEquals($this->customer->getId(), $invoiceItem->customer);
        $this->assertEquals('usd', $invoiceItem->currency);
        $this->assertInternalType('int', $invoiceItem->amount);
    }

    public function testCreateInvoiceItemWithQuantity()
    {
        $invoiceItem = $this->strype->invoiceItem()->create($this->customer,
            new \Bulldog\Strype\Models\InvoiceItems\Quantity(5, 500)
        );
        $this->assertEquals('invoiceitem', $invoiceItem->object);
        $this->assertEquals(1000, $invoiceItem->amount);
        $this->assertEquals($this->customer->getId(), $invoiceItem->customer);
        $this->assertEquals('usd', $invoiceItem->currency);
        $this->assertInternalType('int', $invoiceItem->amount);
    }

    public function testRetrieveInvoiceItem()
    {
        $invoiceItem = $this->strype->invoiceItem()->create($this->customer,
            new \Bulldog\Strype\Models\InvoiceItems\Amount(1000)
        );
        $retrieved = $this->strype->invoiceItem()->retrieve($invoiceItem->id);
        $this->assertEquals('invoiceitem', $retrieved->object);
        $this->assertEquals(1000, $retrieved->amount);
        $this->assertEquals($this->customer->getId(), $retrieved->customer);
        $this->assertEquals('usd', $retrieved->currency);
        $this->assertInternalType('int', $retrieved->amount);
    }

    public function testUpdateInvoiceItem()
    {
        $invoiceItem = $this->strype->invoiceItem()->create($this->customer,
            new \Bulldog\Strype\Models\InvoiceItems\Amount(1000)
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
            new \Bulldog\Strype\Models\InvoiceItems\Amount(1000)
        );
        $deleted = $this->strype->invoiceItem()->delete($invoiceItem->id);
        $this->assertEquals('invoiceitem', $deleted->object);
        $this->assertTrue($deleted->deleted);
    }

    public function testListAllInvoiceItems()
    {
        $items = $this->strype->invoiceItem()->listAll(['limit' => 1]);
        foreach ($items->data as $item) {
            $this->assertEquals('invoiceitem', $item->object);
        }
        $this->assertCount(1, $items->data);
    }
}
