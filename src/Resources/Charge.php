<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Resources\ChargeInterface;
use Bulldog\Strype\Contracts\Resources\CustomerInterface;

/**
 * Class Charge.
 *
 * To charge a credit or a debit card, you create a Charge object. You can retrieve
 * and refund individual charges as well as list all charges. Charges are identified
 * by a unique, random ID. adf
 *
 * @see https://stripe.com/docs/api/charges
 */
class Charge extends Resource implements ChargeInterface, RetrieveInterface, UpdateInterface, ListAllInterface
{
    use Retrieve, Update, ListAll;

    /**
     * Create a charge.
     *
     * To charge a credit card or other payment source, you create a Charge
     * object. If your API key is in test mode, the supplied payment source
     * (e.g., card) won’t actually be charged, although everything else will
     * occur as if in live mode. (Stripe assumes that the charge would have
     * completed successfully).
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
     * Capture a charge.
     *
     * Capture the payment of an existing, uncaptured, charge. This is the second
     * half of the two-step payment flow, where first you created a charge with
     * the capture option set to false.
     *
     * @see https://stripe.com/docs/api/charges/capture
     *
     * @param string $id unique identifier for the object
     *
     * @return ChargeInterface
     */
    public function capture(string $id): ChargeInterface
    {
        $this->stripe('retrieve', $id);
        $this->response->capture();

        return $this;
    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\Charge::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
