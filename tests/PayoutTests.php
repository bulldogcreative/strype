<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

/**
 * @TODO Figure out a good way to test this.
 */
class PayoutTests extends TestCase
{
    public $strype;
    public $id;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
        $this->id = new ObjectId();
    }

    /**
     * @expectedException \Stripe\Error\InvalidRequest
     */
    public function testCreatePayoutWithException()
    {
        // Make the payout amount really high, so it'll hopefully throw an exception
        $payout = $this->strype->payout()->create(50000000, [], $this->id->get(12));
        $this->assertEquals('payout', $payout->object);
    }

    public function testCreatePayout()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_bypassPending');
        $charge = $this->strype->charge()->create($customer, 5000);
        $payout = $this->strype->payout()->create(500, [], $this->id->get(12));
        $this->assertEquals('transfer', $payout->object);
    }

    public function testListAllAndRetrievePayouts()
    {
        $payouts = $this->strype->payout()->listAll(['limit' => 3]);

        $this->assertEquals(3, count($payouts->data));

        foreach ($payouts->data as $payout) {
            $this->assertEquals('transfer', $payout->object);
            // $this->assertEquals('paid', $payout->status);

            $retrievedPayout = $this->strype->payout()->retrieve($payout->id);
            $this->assertEquals($payout->amount, $retrievedPayout->amount);
        }
    }

    public function testUpdatePayout()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_bypassPending');
        $charge = $this->strype->charge()->create($customer, 5000);
        $payout = $this->strype->payout()->create(500, [], $this->id->get(12));
        $result = $this->strype->payout()->update($payout->getId(), [
            'metadata' => [
                'order_id' => '1234'
            ]
        ]);
        $payout = $this->strype->payout()->retrieve($payout->getId());
        $this->assertEquals('1234', $payout->metadata['order_id']);
    }
}
