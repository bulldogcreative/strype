<?php

namespace Bulldog\Strype;

use Bulldog\Strype\Contracts\CustomerPaymentInterface;
use Bulldog\Strype\Contracts\Resources\ChargeInterface;

class Charge extends Resource implements ChargeInterface
{
    /**
     * Unique identifier for the object.
     *
     * Needed for ResourceInterface
     *
     * @var string
     */
    protected $id;

    /**
     * Has the value true if the object exists in live mode or the value false
     * if the object exists in test mode.
     *
     * Needed for ResourceInterface
     *
     * @var bool
     */
    protected $livemode;

    public function create($amount, CustomerPaymentInterface $customer, $arguments = [], $currency = 'usd')
    {
        $arguments['amount'] = $amount;
        $arguments['currency'] = $currency;
        // $customer implements CustomerPaymentInterface which requires $customer
        // to have a getCustomerId method. So we can safely call that method.
        $arguments['customer'] = $customer->getCustomerId();

        $this->stripe('create', $arguments);

        return $this;
    }
}
