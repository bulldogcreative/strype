<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\PayoutInterface;

/**
 * A Payout object is created when you receive funds from Stripe, or when you
 * initiate a payout to either a bank account or debit card of a connected
 * Stripe account. You can retrieve individual payouts, as well as list all
 * payouts. Payouts are made on varying schedules, depending on your country
 * and industry.
 *
 * @see https://stripe.com/docs/api/payouts
 */
class Payout extends Resource implements PayoutInterface
{
    use Retrieve, Update, ListAll;

    /**
     * To send funds to your own bank account, you create a new payout object.
     * Your Stripe balance must be able to cover the payout amount, or you’ll
     * receive an “Insufficient Funds” error.
     *
     * @param int    $amount
     * @param array  $arguments
     * @param string $key
     * @param string $currency
     *
     * @return PayoutInterface
     */
    public function create(int $amount, array $arguments = [], string $key = null, string $currency = 'usd'): PayoutInterface
    {
        $arguments['amount'] = $amount;
        $arguments['currency'] = $currency;
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    /**
     * A previously created payout can be canceled if it has not yet been paid
     * out. Funds will be refunded to your available balance. You may not cancel
     * automatic Stripe payouts.
     *
     * @param string $id the identifier of the payout to be canceled
     *
     * @return PayoutInterface
     */
    public function cancel(string $id): PayoutInterface
    {
        $this->stripe('retrieve', $id);
        $this->response->cancel();

        return $this;
    }

    protected function stripe(string $method, $arguments, $idempotencyKey = null): void
    {
        $this->response = \Stripe\Payout::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
