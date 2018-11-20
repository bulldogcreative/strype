<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Resources\CustomerInterface;

/**
 * Customer objects allow you to perform recurring charges, and to track multiple
 * charges, that are associated with the same customer. The API allows you to
 * create, delete, and update your customers. You can retrieve individual
 * customers as well as a list of all your customers.
 *
 * @see https://stripe.com/docs/api/customers
 */
class Customer extends Resource implements CustomerInterface, RetrieveInterface, UpdateInterface, DeleteInterface, ListAllInterface
{
    use Retrieve, Update, Delete, ListAll;

    /**
     * Create a customer.
     *
     * @see https://stripe.com/docs/api/customers/create
     *
     * @param string      $email
     * @param string      $token
     * @param array       $arguments
     * @param string|null $key
     *
     * @return CustomerInterface
     */
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
