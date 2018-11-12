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
    public $invoiceItem;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
        $this->customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $this->id = new ObjectId();
        $this->invoiceItem = $this->strype->invoiceItem()->create($this->customer,
            new \Bulldog\Strype\Resources\InvoiceItems\Amount(2500)
        );
    }

    public function testCreateInvoiceAndChargeAutomatically()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Resources\Subscriptions\ChargeAutomatically()
        );
        $this->assertEquals('invoice', $invoice->object);
        $this->assertEquals($this->customer->getCustomerId(), $invoice->customer);
        $this->assertEquals(2500, $invoice->total);
    }

    public function testCreateInvoiceAndSend()
    {
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

    public function testUpdateInvoice()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Resources\Subscriptions\SendInvoice(30)
        );
        $updated = $this->strype->invoice()->update($invoice->id, [
            'description' => 'New sled',
        ]);
        $this->assertEquals('invoice', $updated->object);
        $this->assertEquals($this->customer->getCustomerId(), $updated->customer);
        $this->assertEquals(2500, $updated->total);
        $this->assertEquals('New sled', $updated->description);
    }

    public function testDeleteInvoice()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Resources\Subscriptions\ChargeAutomatically()
        );
        $invoice = $this->strype->invoice()->delete($invoice->id);
        $this->assertTrue($invoice->deleted);
    }

    public function testFinalizeInvoice()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Resources\Subscriptions\ChargeAutomatically()
        );
        $updated = $this->strype->invoice()->finalizeInvoice($invoice->id);
        $this->assertEquals('open', $updated->status);
    }

    public function testPayInvoice()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Resources\Subscriptions\ChargeAutomatically()
        );
        $updated = $this->strype->invoice()->pay($invoice->id);
        $this->assertEquals('paid', $updated->status);
    }

    public function testSendInvoiceForManualPayment()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Resources\Subscriptions\SendInvoice(30)
        );
        $updated = $this->strype->invoice()->sendInvoice($invoice->id);
        $this->assertEquals('invoice', $updated->object);
    }

    public function testVoidInvoice()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Resources\Subscriptions\ChargeAutomatically()
        );
        $updated = $this->strype->invoice()->finalizeInvoice($invoice->id);

        $voidedInvoice = $this->strype->invoice()->voidInvoice($updated->id);
        $this->assertEquals('void', $voidedInvoice->status);
    }

    public function testMarkInvoiceAsUncollectable()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Resources\Subscriptions\ChargeAutomatically()
        );
        $updated = $this->strype->invoice()->finalizeInvoice($invoice->id);
        $invoice = $this->strype->invoice()->markUncollectible($invoice->id);
        $this->assertEquals('uncollectible', $invoice->status);
    }

    public function testReceiveInvoiceLineItems()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Resources\Subscriptions\ChargeAutomatically()
        );

        $lineItems = $this->strype->invoice()->retrieveLineItems($invoice->id);
        $this->assertCount(1, $lineItems->data);
    }

    /**
     * @expectedException Stripe\Error\InvalidRequest
     */
    public function testRetrieveUpcomingInvoice()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Resources\Subscriptions\SendInvoice(30)
        );
        $updated = $this->strype->invoice()->finalizeInvoice($invoice->id);
        $upcoming = $this->strype->invoice()->upcoming($this->customer);
    }

    /**
     * @expectedException Stripe\Error\InvalidRequest
     */
    public function testRetrieveUpcomingInvoiceLineItems()
    {
        $invoice = $this->strype->invoice()->create($this->customer,
            new \Bulldog\Strype\Resources\Subscriptions\SendInvoice(30)
        );
        $updated = $this->strype->invoice()->finalizeInvoice($invoice->id);
        $upcoming = $this->strype->invoice()->retrieveUpcomingLineItems($this->customer);
    }

    public function testListAllInvoices()
    {
        $invoices = $this->strype->invoice()->listAll(['limit' => 1]);
        $this->assertCount(1, $invoices->data);
    }

    public function tearDown()
    {
        $this->customer->getResponse()->delete();
    }
}
