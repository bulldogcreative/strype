<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

class SubscriptionItemTests extends TestCase
{
    public $strype;
    public $id;
    public $customer;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
        $this->id = new ObjectId();
        $this->customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
    }

    public function testCreateSubscriptionItem()
    {
        $subscription = $this->createSubscription($this->createPlan()['plan']);

        $plan = $this->createPlan();
        $subscriptionItem = $this->createSubscriptionItem($subscription, $plan['plan']);

        $this->assertEquals($plan['name'], $subscriptionItem->plan->name);
        $this->assertEquals($subscription->getId(), $subscriptionItem->subscription);
        $this->assertEquals('subscription_item', $subscriptionItem->object);
    }

    public function testRetrieveSubscriptionItem()
    {
        $subscription = $this->createSubscription($this->createPlan()['plan']);
        $subscriptionItem = $this->createSubscriptionItem($subscription, $this->createPlan()['plan']);

        $si = $this->strype->subscriptionItem()->retrieve($subscriptionItem->id);
        $this->assertEquals('subscription_item', $si->object);
    }

    public function testUpdateSubscriptionItem()
    {
        $subscription = $this->createSubscription($this->createPlan()['plan']);
        $subscriptionItem = $this->createSubscriptionItem($subscription, $this->createPlan()['plan']);

        $si = $this->strype->subscriptionItem()->update($subscriptionItem->id, [
            'metadata' => [
                'notes' => 'yellow'
            ]
        ]);
        $this->assertEquals('subscription_item', $si->object);
        $this->assertEquals('yellow', $si->metadata['notes']);
    }

    public function testDeleteSubscriptionItem()
    {
        $subscription = $this->createSubscription($this->createPlan()['plan']);
        $subscriptionItem = $this->createSubscriptionItem($subscription, $this->createPlan()['plan']);

        $si = $this->strype->subscriptionItem()->delete($subscriptionItem->id);
        $this->assertTrue($si->deleted);
    }

    public function testListAllSubscriptionItem()
    {
        $subscription = $this->createSubscription($this->createPlan()['plan']);
        $sis = $this->strype->subscriptionItem()->listAll([
            'subscription' => $subscription->id,
        ]);
        $this->assertEquals('subscription_item', $sis->data[0]->object);
    }

    public function createPlan()
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
            "id" => $id
        ]);

        return [
            'name' => $name,
            'id' => $id,
            'plan' => $plan,
        ];
    }

    public function createSubscription($plan)
    {
        $subscription = $this->strype->subscription()->create(
            $this->customer, new \Bulldog\Strype\Resources\Subscriptions\ChargeAutomatically(),
            [
                ['plan' => $plan->id],
            ]
        );

        return $subscription;
    }

    public function createSubscriptionItem($subscription, $plan, $quantity = 2)
    {
        $subscriptionItem = $this->strype->subscriptionItem()->create(
            $plan,
            $subscription,
            [
                'quantity' => $quantity
            ],
            $this->id->get(12)
        );

        return $subscriptionItem;
    }

    public function tearDown()
    {
        $this->customer->getResponse()->delete();
    }
}
