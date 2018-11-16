<?php

namespace Strype;

class UsageRecordTest extends TestCase
{
    const TEST_RESOURCE_ID = 'usage_record';

    public function testCreateUsageRecord()
    {
        $plan = $this->strype->plan()->create([
            'amount' => 2000,
            'interval' => 'month',
            'product' => [
                'name' => 'name',
            ],
            'currency' => 'usd',
            'id' => 1234,
        ]);
        $subscription = $this->strype->subscription()->create(
            $this->strype->customer()->create('levi@example.com', 'tok_mastercard'),
            new \Bulldog\Strype\Models\Subscriptions\ChargeAutomatically(),
            [
                ['plan' => $plan->id],
            ]
        );
        $subscriptionItem = $this->strype->subscriptionItem()->create(
            $plan,
            $subscription,
            [],
            $this->id->get(12)
        );

        $usageRecord = $this->strype->usageRecord()->create(100, $subscriptionItem, strtotime("+2 weeks"));
        $this->assertStringStartsWith('mbur_', $usageRecord->id);
        $this->assertEquals('usage_record', $usageRecord->object);
    }

    public function testUsageRecordSummaries()
    {
        $plan = $this->strype->plan()->create([
            'amount' => 2000,
            'interval' => 'month',
            'product' => [
                'name' => 'name',
            ],
            'currency' => 'usd',
            'id' => 1234,
        ]);
        $subscription = $this->strype->subscription()->create(
            $this->strype->customer()->create('levi@example.com', 'tok_mastercard'),
            new \Bulldog\Strype\Models\Subscriptions\ChargeAutomatically(),
            [
                ['plan' => $plan->id],
            ]
        );
        $subscriptionItem = $this->strype->subscriptionItem()->create(
            $plan,
            $subscription,
            [],
            $this->id->get(12)
        );

        $response = $this->strype->usageRecord()->usageRecordSummaries($subscriptionItem);
        $this->assertStringStartsWith('sis_', $response->getResponse()->data[0]->id);
        $this->assertEquals('subscription_item', $response->object);
    }
}
