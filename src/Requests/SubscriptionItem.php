<?php

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Contracts\Requests\PlanInterface;
use Bulldog\Strype\Contracts\Requests\SubscriptionInterface;
use Bulldog\Strype\Contracts\Requests\SubscriptionItemInterface;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Request;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;

class SubscriptionItem extends Request implements SubscriptionItemInterface, RetrieveInterface, UpdateInterface, DeleteInterface, ListAllInterface
{
    use Retrieve, Update, Delete, ListAll;

    public function create(PlanInterface $plan, SubscriptionInterface $subscription, array $arguments = [], $key = null)
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
