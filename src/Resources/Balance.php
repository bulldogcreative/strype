<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Resources\BalanceInterface;

class Balance extends Resource implements BalanceInterface, RetrieveInterface
{
    use Retrieve;

    public function retrieveBalance()
    {
        $this->response = \Stripe\Balance::retrieve();
        $this->setProperties();

        return $this;
    }

    protected function stripe(string $method, $arguments)
    {
        $this->response = \Stripe\BalanceTransaction::{$method}($arguments);
        $this->setProperties();
    }
}
