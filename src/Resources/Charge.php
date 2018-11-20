<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\ChargeInterface;
use Bulldog\Strype\Contracts\Resources\CustomerInterface;

/**
 * To charge a credit or a debit card, you create a Charge object. You can retrieve
 * and refund individual charges as well as list all charges. Charges are identified
 * by a unique, random ID.
 *
 * @see https://stripe.com/docs/api/charges
 */
class Charge extends Resource implements ChargeInterface
{
    use Retrieve, Update, ListAll;

    /**
     * Charge a Customer. A Customer must have some sort of payment source. Usually
     * they payment source is a card, and it is added via a token that is created
     * using JavaScript on the front end. This helps keep your application PCI
     * compliant.
     *
     * @see https://stripe.com/docs/api/charges/create
     *
     * @param CustomerInterface $customer
     * @param int               $amount
     * @param array             $arguments
     * @param string|null       $key
     * @param string            $currency
     *
     * @return ChargeInterface
     */
    public function create(CustomerInterface $customer, int $amount, array $arguments = [], string $key = null, string $currency = 'usd'): ChargeInterface
    {
        $arguments['customer'] = $customer->getId();
        $arguments['amount'] = $amount;
        $arguments['currency'] = $currency;
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    /**
     * Capture the payment of an existing, uncaptured, charge. This is the second
     * half of the two-step payment flow, where first you created a charge with
     * the capture option set to false.
     *
     * @see https://stripe.com/docs/api/charges/capture
     *
     * @param string $id The identifier of the charge to be captured
     *
     * @return ChargeInterface
     */
    public function capture(string $id): ChargeInterface
    {
        $this->stripe('retrieve', $id);
        $this->response->capture();

        return $this;
    }

    /**
     * Call the Stripe API.
     *
     * @param string $method
     * @param mixed  $arguments
     * @param string $idempotencyKey
     */
    protected function stripe(string $method, $arguments, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\Charge::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
