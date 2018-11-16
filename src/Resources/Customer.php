<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Contracts\Resources\CustomerInterface;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;

class Customer extends Resource implements CustomerInterface, RetrieveInterface, UpdateInterface, DeleteInterface, ListAllInterface
{
    use Retrieve, Update, Delete, ListAll;

    public function create(string $email, string $token, array $arguments = [], string $key = null): CustomerInterface
    {
        $arguments['email'] = $email;
        $arguments['source'] = $token;
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\Customer::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
