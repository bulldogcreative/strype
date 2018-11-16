<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Contracts\Resources\CustomerInterface;
use Bulldog\Strype\Contracts\Resources\DiscountInterface;
use Bulldog\Strype\Contracts\Resources\SubscriptionInterface;

class Discount extends Resource implements DiscountInterface
{
    public function deleteCustomerDiscount(CustomerInterface $customer, string $key = null): DiscountInterface
    {
        $this->customer($customer->getId(), $key);
        $this->response->deleteDiscount();

        return $this;
    }

    public function deleteSubscriptionDiscount(SubscriptionInterface $subscription): DiscountInterface
    {
        $this->subscription($subscription->getId());
        $this->response->deleteDiscount();
        $this->deleted = true;

        return $this;
    }

    protected function customer($id, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\Customer::retrieve($id, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }

    protected function subscription($id, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\Subscription::retrieve($id, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
