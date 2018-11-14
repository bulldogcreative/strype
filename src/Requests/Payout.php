<?php

declare(strict_types=1);

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Request;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Requests\PayoutInterface;

class Payout extends Request implements PayoutInterface, RetrieveInterface, ListAllInterface, UpdateInterface
{
    use Retrieve, Update, ListAll;

    public function create(int $amount, $arguments = [], $key = null, $currency = 'usd')
    {
        $arguments['amount'] = $amount;
        $arguments['currency'] = $currency;
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    public function cancel(string $id)
    {
        $this->stripe('retrieve', $id);
        $this->response->cancel();

        return $this;
    }

    protected function stripe(string $method, $arguments, $idempotencyKey = null)
    {
        $this->response = \Stripe\Payout::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
