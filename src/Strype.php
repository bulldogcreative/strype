<?php

namespace Bulldog\Strype;

use Bulldog\Strype\Resources\Balance;
use Bulldog\Strype\Resources\Charge;
use Bulldog\Strype\Resources\Customer;
use Bulldog\Strype\Resources\Dispute;
use Bulldog\Strype\Resources\Event;
use Bulldog\Strype\Resources\File;
use Bulldog\Strype\Resources\FileLink;
use Bulldog\Strype\Resources\Payout;
use Bulldog\Strype\Resources\Product;
use Bulldog\Strype\Resources\Refund;
use Bulldog\Strype\Contracts\Resources\CustomerInterface;

/**
 * Class Strype.
 */
class Strype
{
    /**
     * Strype constructor.
     *
     * @param string $apikey
     */
    public function __construct(string $apikey)
    {
        \Stripe\Stripe::setApiKey($apikey);
    }

    public function balance()
    {
        return new Balance();
    }

    public function customer()
    {
        return new Customer();
    }

    public function charge()
    {
        return new Charge();
    }

    public function chargeCustomer(CustomerInterface $customer, int $amount, $key = null)
    {
        $charge = new Charge();

        return $charge->create($customer, $amount, $key);
    }

    public function dispute()
    {
        return new Dispute();
    }

    public function event()
    {
        return new Event();
    }

    public function file()
    {
        return new File();
    }

    public function fileLink()
    {
        return new FileLink();
    }

    public function payout()
    {
        return new Payout();
    }

    public function product()
    {
        return new Product();
    }

    public function refund()
    {
        return new Refund();
    }
}