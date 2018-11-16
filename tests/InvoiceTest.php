<?php

namespace Strype;

class InvoiceTest extends TestCase
{
    public function testCreateInvoiceAndChargeAutomatically()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Models\Subscriptions\ChargeAutomatically()
        );
        $this->assertEquals('invoice', $invoice->object);
        $this->assertEquals($this->customer->getId(), $invoice->customer);
        $this->assertEquals(0, $invoice->total);
        $this->assertInstanceOf("Stripe\\Invoice", $invoice->getResponse());
    }

    public function testCreateInvoiceAndSend()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Models\Subscriptions\SendInvoice(30)
        );
        $this->assertEquals('invoice', $invoice->object);
        $this->assertEquals($this->customer->getId(), $invoice->customer);
        $this->assertEquals(0, $invoice->total);
        $this->assertInstanceOf("Stripe\\Invoice", $invoice->getResponse());
    }

    public function testRetrieveInvoice()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Models\Subscriptions\SendInvoice(30)
        );
        $retrieved = $this->strype->invoice()->retrieve($invoice->id);
        $this->assertEquals('invoice', $retrieved->object);
        $this->assertEquals($this->customer->getId(), $retrieved->customer);
        $this->assertEquals(0, $retrieved->total);
        $this->assertInstanceOf("Stripe\\Invoice", $retrieved->getResponse());
    }

    public function testUpdateInvoice()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Models\Subscriptions\SendInvoice(30)
        );
        $updated = $this->strype->invoice()->update($invoice->id, [
            'description' => 'New sled',
        ]);
        $this->assertEquals('invoice', $updated->object);
        $this->assertEquals($this->customer->getId(), $updated->customer);
        $this->assertEquals(0, $updated->total);
        $this->assertEquals('New sled', $updated->description);
        $this->assertInstanceOf("Stripe\\Invoice", $updated->getResponse());
    }

    public function testDeleteInvoice()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Models\Subscriptions\ChargeAutomatically()
        );
        $invoice = $this->strype->invoice()->delete($invoice->id);
        $this->assertTrue($invoice->deleted);
        $this->assertInstanceOf("Stripe\\Invoice", $invoice->getResponse());
    }

    public function testFinalizeInvoice()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Models\Subscriptions\ChargeAutomatically()
        );
        $updated = $this->strype->invoice()->finalizeInvoice($invoice->id);
        $this->assertInstanceOf("Stripe\\Invoice", $updated->getResponse());
    }

    public function testPayInvoice()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Models\Subscriptions\ChargeAutomatically()
        );
        $updated = $this->strype->invoice()->pay($invoice->id);
        $this->assertInstanceOf("Stripe\\Invoice", $updated->getResponse());
    }

    public function testSendInvoiceForManualPayment()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Models\Subscriptions\SendInvoice(30)
        );
        $updated = $this->strype->invoice()->sendInvoice($invoice->id);
        $this->assertEquals('invoice', $updated->object);
        $this->assertInstanceOf("Stripe\\Invoice", $updated->getResponse());
    }

    public function testVoidInvoice()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Models\Subscriptions\ChargeAutomatically()
        );
        $updated = $this->strype->invoice()->finalizeInvoice($invoice->id);

        $voidedInvoice = $this->strype->invoice()->voidInvoice($updated->id);
        $this->assertEquals('draft', $voidedInvoice->status);
        $this->assertInstanceOf("Stripe\\Invoice", $voidedInvoice->getResponse());
    }

    public function testMarkInvoiceAsUncollectable()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Models\Subscriptions\ChargeAutomatically()
        );
        $updated = $this->strype->invoice()->finalizeInvoice($invoice->id);
        $invoice = $this->strype->invoice()->markUncollectible($invoice->id);
        $this->assertEquals('draft', $invoice->status);
        $this->assertInstanceOf("Stripe\\Invoice", $invoice->getResponse());
    }

    public function testReceiveInvoiceLineItems()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Models\Subscriptions\ChargeAutomatically()
        );

        $lineItems = $this->strype->invoice()->retrieveLineItems($invoice->id);
        $this->assertCount(1, $lineItems->data);
    }

    public function testRetrieveUpcomingInvoice()
    {
        $customer = $this->strype->customer()->retrieve('cus_DxiWAfQMgD1WJy');
        $upcoming = $this->strype->invoice()->upcoming($this->customer);
        $this->assertEquals('manual', $upcoming->billing_reason);
    }

    public function testListAllInvoices()
    {
        $invoices = $this->strype->invoice()->listAll(['limit' => 1]);
        $this->assertCount(1, $invoices->data);
    }

    public function testRetrieveUpcomingInvoiceLineItems()
    {
        $customer = $this->strype->customer()->retrieve('cus_DxiWAfQMgD1WJy');
        $upcoming = $this->strype->invoice()->retrieveUpcomingLineItems($customer);
        $this->assertCount(1, $upcoming->data);
    }
}
