<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\BalanceInterface;

/**
 * This is an object representing your Stripe balance. You can retrieve it to see
 * the balance currently on your Stripe account.
 *
 * You can also retrieve the balance history, which contains a list of transactions
 * that contributed to the balance (charges, payouts, and so forth).
 *
 * The available and pending amounts for each currency are broken down further by
 * payment source types.
 *
 * @see https://stripe.com/docs/api/balance
 */
class Balance extends Resource implements BalanceInterface
{
    /**
     * Retrieves the current account balance, based on the authentication that
     * was used to make the request.
     *
     * @see https://stripe.com/docs/api/balance/balance_retrieve
     *
     * @return BalanceInterface
     */
    public function retrieve(): BalanceInterface
    {
        $this->response = \Stripe\Balance::retrieve();
        $this->setProperties();

        return $this;
    }

    /**
     * Retrieves the balance transaction with the given ID.
     *
     * @see https://stripe.com/docs/api/balance/balance_transaction_retrieve
     *
     * @param string $id The ID of the desired balance transaction
     *
     * @return BalanceInterface
     */
    public function retrieveBalanceTransaction(string $id): BalanceInterface
    {
        $this->response = \Stripe\BalanceTransaction::retrieve($id);
        $this->setProperties();

        return $this;
    }
}
