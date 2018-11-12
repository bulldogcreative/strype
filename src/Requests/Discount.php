<?php

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Request;
use Bulldog\Strype\Contracts\Requests\CustomerInterface;
use Bulldog\Strype\Contracts\Requests\DiscountInterface;
use Bulldog\Strype\Contracts\Requests\SubscriptionInterface;

class Discount extends Request implements DiscountInterface
{
    public function deleteCustomerDiscount(CustomerInterface $customer, $key = null)
    {
        $this->customer($customer->getCustomerId(), $key);
        $this->response->deleteDiscount();

        return $this;
    }

    public function deleteSubscriptionDiscount(SubscriptionInterface $subscription)
    {
        $this->subscription($subscription->getId());
        $this->response->deleteDiscount();
        $this->deleted = true;

        return $this;
    }

    protected function customer($id, $idempotencyKey = null)
    {
        $this->response = \Stripe\Customer::retrieve($id, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }

    protected function subscription($id, $idempotencyKey = null)
    {
        $this->response = \Stripe\Subscription::retrieve($id, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}