<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Resources\CustomerInterface;
use Bulldog\Strype\Contracts\Resources\SubscriptionInterface;
use Bulldog\Strype\Contracts\Models\SubscriptionBillingTypeInterface;

class Subscription extends Resource implements SubscriptionInterface, RetrieveInterface, UpdateInterface, ListAllInterface
{
    use Retrieve, Update, ListAll;

    public function create(CustomerInterface $customer, SubscriptionBillingTypeInterface $billing, array $items = [], array $arguments = [], string $key = null): SubscriptionInterface
    {
        $arguments = array_merge($arguments, $billing->toArray());
        $arguments['customer'] = $customer->getId();
        $arguments['items'] = $items;
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    public function cancel($id): SubscriptionInterface
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
