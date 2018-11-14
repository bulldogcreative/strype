<?php

declare(strict_types=1);

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Request;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Requests\BalanceInterface;

class Balance extends Request implements BalanceInterface, RetrieveInterface
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
