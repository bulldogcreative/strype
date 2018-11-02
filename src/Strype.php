<?php

namespace Bulldog\Strype;

/**
 * Simple Factory class.
 */
class Strype
{
    /**
     * Strype construct.
     *
     * @param string $apikey
     */
    public function __construct($apikey)
    {
        \Stripe\Stripe::setApiKey($apikey);
    }

    /**
     * Instantiate Charge.
     */
    public function charges()
    {
        return new Charge();
    }

    /**
     * Instantiate Customer.
     */
    public function customers()
    {
        return new Customer();
    }
}
