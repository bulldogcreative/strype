<?php

declare(strict_types=1);

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Contracts\Requests\ChargeInterface;
use Bulldog\Strype\Contracts\Requests\RefundInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Request;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;

class Refund extends Request implements RefundInterface, RetrieveInterface, ListAllInterface, UpdateInterface
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
