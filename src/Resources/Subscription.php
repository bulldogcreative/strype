<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\CustomerInterface;
use Bulldog\Strype\Contracts\Resources\SubscriptionInterface;
use Bulldog\Strype\Contracts\Models\SubscriptionBillingTypeInterface;

/**
 * Subscriptions allow you to charge a customer on a recurring basis. A subscription
 * ties a customer to a particular plan you've created.
 *
 * @see https://stripe.com/docs/api/subscriptions
 */
class Subscription extends Resource implements SubscriptionInterface
{
    use Retrieve, Update, ListAll;

    /**
     * Creates a new subscription on an existing customer.
     *
     * @see https://stripe.com/docs/api/subscriptions/create
     *
     * @param CustomerInterface                $customer
     * @param SubscriptionBillingTypeInterface $billing
     * @param array                            $items
     * @param array                            $arguments
     * @param string                           $key
     *
     * @return SubscriptionInterface
     */
    public function create(CustomerInterface $customer, SubscriptionBillingTypeInterface $billing, array $items = [], array $arguments = [], string $key = null): SubscriptionInterface
    {
        $arguments = array_merge($arguments, $billing->toArray());
        $arguments['customer'] = $customer->getId();
        $arguments['items'] = $items;
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    /**
     * Cancels a customer’s subscription immediately. The customer will not be
     * charged again for the subscription.
     *
     * @see https://stripe.com/docs/api/subscriptions/cancel
     *
     * @param string $id
     *
     * @return SubscriptionInterface
     */
    public function cancel(string $id): SubscriptionInterface
    {
        $this->stripe('retrieve', $id);
        $this->response = $this->response->cancel();
        $this->setProperties();

        return $this;
    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\Subscription::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
