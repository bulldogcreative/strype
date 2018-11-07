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
    public function testCreatePayout()
    {
        // Make the payout amount really high, so it'll hopefully throw an exception
        $payout = $this->strype->payout()->create(50000000, [], $this->id->get(12));
        $this->assertEquals('payout', $payout->object);
    }

    public function testListAllAndRetrievePayouts()
    {
        $payouts = $this->strype->payout()->listAll(['limit' => 3]);

        $this->assertEquals(3, count($payouts->data));

        foreach ($payouts->data as $payout) {
            $this->assertEquals('transfer', $payout->object);
            $this->assertEquals('STRIPE PAYOUT', $payout->description);
            $this->assertEquals('paid', $payout->status);

            $retrievedPayout = $this->strype->payout()->retrieve($payout->id);
            $this->assertEquals($payout->amount, $retrievedPayout->amount);
        }
    }
}
