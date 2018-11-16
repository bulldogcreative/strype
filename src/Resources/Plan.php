<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Contracts\Requests\PlanInterface;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;

class Plan extends Resource implements PlanInterface, RetrieveInterface, ListAllInterface, UpdateInterface, DeleteInterface
{
    use Retrieve, Update, ListAll, Delete;

    /**
     * Creating a plan has complicated requirements. So for now, it'll accept an
     * array.
     *
     * @TODO redo
     *
     * @param array  $arguments
     * @param string $key
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
