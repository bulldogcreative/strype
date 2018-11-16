<?php

declare(strict_types=1);

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Contracts\Requests\BalanceInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Retrieve;

class Balance extends Resource implements BalanceInterface, RetrieveInterface
{
    use Retrieve;

    public function retrieveBalance(): BalanceInterface
    {
        $this->response = \Stripe\Balance::retrieve();
        $this->setProperties();

        return $this;
    }

    protected function stripe(string $method, $arguments): void
    {
        $this->response = \Stripe\BalanceTransaction::{$method}($arguments);
        $this->setProperties();
    }
}
