<?php

declare(strict_types=1);

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Contracts\Requests\CustomerInterface;
use Bulldog\Strype\Contracts\Requests\DiscountInterface;
use Bulldog\Strype\Contracts\Requests\SubscriptionInterface;
use Bulldog\Strype\Request;

class Discount extends Request implements DiscountInterface
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
