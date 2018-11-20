<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Resources\PlanInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;

/**
 * Plans define the base price, currency, and billing cycle for subscriptions.
 * For example, you might have a $5/month plan that provides limited access to
 * your products, and a $15/month plan that allows full access.
 *
 * @see https://stripe.com/docs/api/plans
 */
class Plan extends Resource implements PlanInterface, RetrieveInterface, ListAllInterface, UpdateInterface, DeleteInterface
{
    use Retrieve, Update, ListAll, Delete;

    /**
     * You can create plans using the API, or in the Stripe Dashboard.
     *
     * @param array  $arguments
     * @param string $key
     *
     * @return PlanInterface
     */
    public function create(array $arguments, string $key = null): PlanInterface
    {
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null)
    {
        $this->response = \Stripe\Plan::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
