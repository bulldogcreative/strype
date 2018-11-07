<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Resources\ChargeInterface;
use Bulldog\Strype\Contracts\Resources\CustomerInterface;

class Charge extends Resource implements ChargeInterface, RetrieveInterface, UpdateInterface, ListAllInterface
{
    use Retrieve, Update, ListAll;

    public function create(CustomerInterface $customer, int $amount, array $arguments = [], $key = null, string $currency = 'usd')
    {
        $arguments['customer'] = $customer->getCustomerId();
        $arguments['amount'] = $amount;
        $arguments['currency'] = $currency;
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    public function capture(string $id)
    {
        $this->stripe('retrieve', $id);
        $this->response->capture();

        return $this;
    }

    protected function stripe(string $method, $arguments, $idempotencyKey = null)
    {
        $this->response = \Stripe\Charge::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}