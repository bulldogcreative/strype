<?php

namespace Strype;

class SubscriptionTest extends TestCase
{
    public function testCreateSubscriptionAndChargeAutomatically()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $plan = \Stripe\Plan::create([
            'amount' => 5000,
            'interval' => 'month',
            'product' => [
                'name' => 'Gold special',
            ],
            'currency' => 'usd',
            'id' => 'gold-special'.$this->id->get(12),
        ]);
        $subscription = $this->strype->subscription()->create(
            $customer, new \Bulldog\Strype\Models\Subscriptions\ChargeAutomatically(),
            [
                ['plan' => $plan->id],
            ]
        );
        $this->assertEquals('subscription', $subscription->object);
        $this->assertEquals($customer->getId(), $subscription->customer);
        $this->assertEquals('charge_automatically', $subscription->billing);
    }

    public function testCreateSubscriptionAndSendInvoice()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $plan = \Stripe\Plan::create([
            'amount' => 5000,
            'interval' => 'month',
            'product' => [
                'name' => 'Gold special',
            ],
            'currency' => 'usd',
            'id' => 'gold-special'.$this->id->get(12),
        ]);
        $subscription = $this->strype->subscription()->create(
            $customer, new \Bulldog\Strype\Models\Subscriptions\SendInvoice(12),
            [
                ['plan' => $plan->id],
            ]
        );
        $this->assertEquals('subscription', $subscription->object);
        $this->assertEquals($customer->getId(), $subscription->customer);
        $this->assertEquals('send_invoice', $subscription->billing);
    }

    public function testRetrieveSubscription()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $plan = \Stripe\Plan::create([
            'amount' => 5000,
            'interval' => 'month',
            'product' => [
                'name' => 'Gold special',
            ],
            'currency' => 'usd',
            'id' => 'gold-special'.$this->id->get(12),
        ]);
        $subscription = $this->strype->subscription()->create(
            $customer, new \Bulldog\Strype\Models\Subscriptions\SendInvoice(12),
            [
                ['plan' => $plan->id],
            ]
        );

        $retrieved = $this->strype->subscription()->retrieve($subscription->id);
        $this->assertEquals('subscription', $retrieved->object);
        $this->assertEquals($customer->getId(), $retrieved->customer);
    }

    public function testUpdateSubscription()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $plan = \Stripe\Plan::create([
            'amount' => 5000,
            'interval' => 'month',
            'product' => [
                'name' => 'Gold special',
            ],
            'currency' => 'usd',
            'id' => 'gold-special'.$this->id->get(12),
        ]);
        $subscription = $this->strype->subscription()->create(
            $customer, new \Bulldog\Strype\Models\Subscriptions\SendInvoice(12),
            [
                ['plan' => $plan->id],
            ]
        );

        $updated = $this->strype->subscription()->update($subscription->id, [
            'tax_percent' => 10,
        ]);
        $this->assertEquals(10, $updated->tax_percent);
    }

    public function testCancelSubscription()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $plan = \Stripe\Plan::create([
            'amount' => 5000,
            'interval' => 'month',
            'product' => [
                'name' => 'Gold special',
            ],
            'currency' => 'usd',
            'id' => 'gold-special'.$this->id->get(12),
        ]);
        $subscription = $this->strype->subscription()->create(
            $customer, new \Bulldog\Strype\Models\Subscriptions\SendInvoice(12),
            [
                ['plan' => $plan->id],
            ]
        );

        $cancelled = $this->strype->subscription()->cancel($subscription->id);
        $this->assertInstanceOf('Stripe\Subscription', $cancelled->getResponse());
    }

    public function testListAllSubscriptions()
    {
        $subscriptions = $this->strype->subscription()->listAll(['limit' => 1]);
        foreach ($subscriptions->data as $subscription) {
            $this->assertEquals('subscription', $subscription->object);
        }
        $this->assertEquals(1, count($subscriptions->data));
    }
}
