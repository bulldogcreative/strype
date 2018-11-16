<?php

namespace Strype;

class DiscountTest extends TestCase
{
    public function testDeleteCustomerDiscountWithNoDiscount()
    {
        $newCustomer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $customer = $this->strype->customer()->retrieve($newCustomer->getId());
        $discount = $this->strype->discount()->deleteCustomerDiscount($customer);
        $this->assertInstanceOf("Stripe\\Customer", $discount->getResponse());
    }

    public function testDeleteCustomerDiscount()
    {
        $duration = new \Bulldog\Strype\Models\Durations\Forever();
        $type = new \Bulldog\Strype\Models\Coupons\Amount(1000, 'usd');
        $coupon = $this->strype->coupon()->create($duration, $type, [], $this->id->get(12));

        $newCustomer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard', [
            'coupon' => $coupon->getId(),
        ]);
        $customer = $this->strype->customer()->retrieve($newCustomer->getId());
        $discount = $this->strype->discount()->deleteCustomerDiscount($customer);

        $customer = $this->strype->customer()->retrieve($newCustomer->getId());
        $this->assertEquals($customer->discount, null);
    }

    public function testDeleteSubscriptionDiscount()
    {
        $duration = new \Bulldog\Strype\Models\Durations\Forever();
        $type = new \Bulldog\Strype\Models\Coupons\Amount(1000, 'usd');
        $coupon = $this->strype->coupon()->create($duration, $type, [], $this->id->get(12));

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
            ],
            [
                'coupon' => $coupon->id,
            ]
        );

        $discount = $this->strype->discount()->deleteSubscriptionDiscount($subscription);
        $this->assertTrue($discount->deleted);
    }
}
