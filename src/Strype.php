<?php

namespace Bulldog\Strype;

use Bulldog\Strype\Resources\File;
use Bulldog\Strype\Resources\Plan;
use Bulldog\Strype\Resources\Event;
use Bulldog\Strype\Resources\Token;
use Bulldog\Strype\Resources\Charge;
use Bulldog\Strype\Resources\Coupon;
use Bulldog\Strype\Resources\Payout;
use Bulldog\Strype\Resources\Refund;
use Bulldog\Strype\Resources\Balance;
use Bulldog\Strype\Resources\Dispute;
use Bulldog\Strype\Resources\Invoice;
use Bulldog\Strype\Resources\Product;
use Bulldog\Strype\Resources\Customer;
use Bulldog\Strype\Resources\Discount;
use Bulldog\Strype\Resources\FileLink;
use Bulldog\Strype\Resources\InvoiceItem;
use Bulldog\Strype\Resources\UsageRecord;
use Bulldog\Strype\Resources\Subscription;
use Bulldog\Strype\Resources\SubscriptionItem;
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
        \Stripe\Stripe::setAppInfo("Bulldog\Strype", "0.5.0", "https://github.com/bulldogcreative/strype");
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
