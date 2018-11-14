<?php

declare(strict_types=1);

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Contracts\Requests\CustomerInterface;
use Bulldog\Strype\Contracts\Requests\SubscriptionInterface;
use Bulldog\Strype\Contracts\Resources\SubscriptionBillingInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Request;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;

class Subscription extends Request implements SubscriptionInterface, RetrieveInterface, UpdateInterface, ListAllInterface
{
    use Retrieve, Update, ListAll;

    public function create(CustomerInterface $customer, SubscriptionBillingInterface $billing, array $items = [], array $arguments = [], $key = null)
    {
        $arguments = array_merge($arguments, $billing->getBilling());
        $arguments['customer'] = $customer->getCustomerId();
        $arguments['items'] = $items;
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    public function cancel($id)
    {
        $this->stripe('retrieve', $id);
        $this->response = $this->response->cancel();
        $this->setProperties();

        return $this;
    }

    protected function stripe(string $method, $arguments, $idempotencyKey = null): void
    {
        $this->response = \Stripe\Subscription::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
