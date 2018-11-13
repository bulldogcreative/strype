<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

class UsageRecordTests extends TestCase
{
    public $strype;
    public $id;
    public $subscriptionItem;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
        $this->id = new ObjectId();

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
        $this->subscriptionItem = $this->strype->subscriptionItem()->create(
            $plan2,
            $subscription,
            [],
            $this->id->get(12)
        );
    }

    public function testCreateUsageRecord()
    {
        $usageRecord = $this->strype->usageRecord()->create(100, $this->subscriptionItem, time());
        $this->assertStringStartsWith('mbur_', $usageRecord->id);
        $this->assertEquals('usage_record', $usageRecord->object);
    }

    public function testUsageRecordSummaries()
    {
        $response = $this->strype->usageRecord()->usageRecordSummaries($this->subscriptionItem);
        $this->assertStringStartsWith('sis_', $response->getResponse()->data[0]->id);
        $this->assertEquals('subscription_item', $response->object);
    }
}
