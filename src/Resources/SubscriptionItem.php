<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\PlanInterface;
use Bulldog\Strype\Contracts\Resources\SubscriptionInterface;
use Bulldog\Strype\Contracts\Resources\SubscriptionItemInterface;

/**
 * Subscription items allow you to create customer subscriptions with more than
 * one plan, making it easy to represent complex billing relationships.
 *
 * @see https://stripe.com/docs/api/subscription_items
 */
class SubscriptionItem extends Resource implements SubscriptionItemInterface
{
    use Retrieve, Update, Delete, ListAll;

    /**
     * Adds a new item to an existing subscription. No existing items will be changed or replaced.
     *
     * @param PlanInterface         $plan
     * @param SubscriptionInterface $subscription
     * @param array                 $arguments
     * @param string                $key
     *
     * @return SubscriptionItemInterface
     */
    public function create(PlanInterface $plan, SubscriptionInterface $subscription, array $arguments = [], string $key = null): SubscriptionItemInterface
    {
        $arguments['plan'] = $plan->getId();
        $arguments['subscription'] = $subscription->getId();
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, $idempotencyKey = null)
    {
        $this->response = \Stripe\SubscriptionItem::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
