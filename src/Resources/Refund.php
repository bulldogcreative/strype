<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Contracts\Resources\ChargeInterface;
use Bulldog\Strype\Contracts\Resources\RefundInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;

class Refund extends Resource implements RefundInterface, RetrieveInterface, ListAllInterface, UpdateInterface
{
    use Retrieve, Update, ListAll;

    public function create(ChargeInterface $charge, array $arguments = [], string $key = null): RefundInterface
    {
        $arguments['charge'] = $charge->getId();
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\Refund::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
