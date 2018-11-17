<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\BalanceInterface;

/**
 * Class Balance.
 *
 * @see https://stripe.com/docs/api/balance
 */
class Balance extends Resource implements BalanceInterface
{
    public function retrieve(): BalanceInterface
    {
        $this->response = \Stripe\Balance::retrieve();
        $this->setProperties();

        return $this;
    }

    public function retrieveBalanceTransaction(string $id): BalanceInterface
    {
        $this->response = \Stripe\BalanceTransaction::retrieve($id);
        $this->setProperties();

        return $this;
    }
}
