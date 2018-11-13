<?php

declare(strict_types=1);

namespace Bulldog\Strype;

use Bulldog\Strype\Requests\Balance;
use Bulldog\Strype\Requests\Charge;
use Bulldog\Strype\Requests\Customer;
use Bulldog\Strype\Requests\Dispute;
use Bulldog\Strype\Requests\Event;
use Bulldog\Strype\Requests\File;
use Bulldog\Strype\Requests\FileLink;
use Bulldog\Strype\Requests\Payout;
use Bulldog\Strype\Requests\Product;
use Bulldog\Strype\Requests\Refund;
use Bulldog\Strype\Requests\Token;
use Bulldog\Strype\Requests\Coupon;
use Bulldog\Strype\Requests\Discount;
use Bulldog\Strype\Requests\Subscription;
use Bulldog\Strype\Requests\InvoiceItem;
use Bulldog\Strype\Requests\Invoice;
use Bulldog\Strype\Requests\Plan;
use Bulldog\Strype\Requests\SubscriptionItem;
use Bulldog\Strype\Requests\UsageRecord;
use Bulldog\Strype\Contracts\Requests\CustomerInterface;

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

    public function token()
    {
        return new Token();
    }

    public function coupon()
    {
        return new Coupon();
    }

    public function discount()
    {
        return new Discount();
    }

    public function subscription()
    {
        return new Subscription();
    }

    public function invoiceItem()
    {
        return new InvoiceItem();
    }

    public function invoice()
    {
        return new Invoice();
    }

    public function plan()
    {
        return new Plan();
    }

    public function subscriptionItem()
    {
        return new SubscriptionItem();
    }

    public function usageRecord()
    {
        return new UsageRecord();
    }
}
