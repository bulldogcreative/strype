<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Resources\CustomerInterface;

/**
 * Class Customer.
 *
 * Also implements:
 * Bulldog\Strype\Contracts\DeleteInterface;
 * Bulldog\Strype\Contracts\RetrieveInterface;
 * Bulldog\Strype\Contracts\UpdateInterface;
 */
class Customer extends Resource implements CustomerInterface, RetrieveInterface, UpdateInterface, DeleteInterface, ListAllInterface
{
    use Retrieve, Update, Delete, ListAll;

    public function create(string $email, string $token, $arguments = [], $key = null)
    {
        $arguments['email'] = $email;
        $arguments['source'] = $token;
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    /**
     * Get customer ID.
     *
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->id;
    }

    protected function stripe(string $method, $arguments, $idempotencyKey = null)
    {
        $this->response = \Stripe\Customer::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}