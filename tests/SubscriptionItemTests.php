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
            $customer, new \Bulldog\Strype\Resources\Subscriptions\ChargeAutomatically(),
            [
                ['plan' => $plan->id],
            ]
        );

        return $subscription;
    }

    public function createSubscriptionItem($subscription, $plan, $quantity = 2)
    {
        $subscriptionItem = $this->strype->subscriptionItem()->create(
            $subscription->getId(),
            $plan->getId(),
            [
                'quantity' => $quantity
            ],
            $this->id->get(12)
        );
    }
}
