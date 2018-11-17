<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Contracts\Resources\CustomerInterface;
use Bulldog\Strype\Contracts\Resources\DiscountInterface;
use Bulldog\Strype\Contracts\Resources\SubscriptionInterface;

/**
 * Discount class.
 *
 * @see https://stripe.com/docs/api/discounts
 */
class Discount extends Resource implements DiscountInterface
{
    /**
     * Delete a customer discount.
     *
     * Removes the currently applied discount on a customer.
     *
     * @see https://stripe.com/docs/api/discounts/delete
     *
     * @param CustomerInterface $customer
     * @param string            $key
     *
     * @return DiscountInterface
     */
    public function deleteCustomerDiscount(CustomerInterface $customer, string $key = null): DiscountInterface
    {
        $this->customer($customer->getId(), $key);
        $this->response->deleteDiscount();

        return $this;
    }

    /**
     * Delete a subscription discount.
     *
     * Removes the currently applied discount on a subscription.
     *
     * @see https://stripe.com/docs/api/discounts/subscription_delete
     *
     * @param SubscriptionInterface $subscription
     *
     * @return DiscountInterface
     */
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
