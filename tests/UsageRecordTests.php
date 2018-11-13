<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

class UsageRecordTests extends TestCase
{
    public $strype;
    public $id;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
        $this->id = new ObjectId();
    }

    public function testCreateUsageRecord()
    {
        $name = "Gold special" . $this->id->get(12);
        $id = "gold-special" . $this->id->get(12);
        $plan = $this->strype->plan()->create([
            "amount" => 5000,
            "interval" => "month",
            "product" => [
                "name" => $name
            ],
            "currency" => "usd",
            "id" => $id,
            'usage_type' => 'metered'
        ]);
        $plan2 = $this->strype->plan()->create([
            "amount" => 5000,
            "interval" => "month",
            "product" => [
                "name" => $name
            ],
            "currency" => "usd",
            "id" => $this->id->get(12),
            'usage_type' => 'metered'
        ]);
        $subscription = $this->strype->subscription()->create(
            $this->strype->customer()->create('levi@example.com', 'tok_mastercard'),
            new \Bulldog\Strype\Resources\Subscriptions\ChargeAutomatically(),
            [
                ['plan' => $plan->id],
            ]
        );
        $subscriptionItem = $this->strype->subscriptionItem()->create(
            $plan2,
            $subscription,
            [],
            $this->id->get(12)
        );

        $usageRecord = $this->strype->usageRecord()->create(100, $subscriptionItem, time());
        $this->assertStringStartsWith('mbur_', $usageRecord->id);
        $this->assertEquals('usage_record', $usageRecord->object);
    }
}
