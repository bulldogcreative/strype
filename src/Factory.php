<?php

namespace Bulldog\Strype;

use Bulldog\Strype\Contracts\Models\CouponTypeInterface;
use Bulldog\Strype\Models\Coupons\Amount as CouponAmount;
use Bulldog\Strype\Models\Coupons\Percent as CouponPercent;
use Bulldog\Strype\Models\Durations\Forever as DurationForever;
use Bulldog\Strype\Models\Durations\Once as DurationOnce;
use Bulldog\Strype\Models\Durations\Repeating as DurationRepeating;
use Bulldog\Strype\Models\Files\BusinessLogo as FileBusinessLogo;
use Bulldog\Strype\Models\Files\CustomerSignature as FileCustomerSignature;

class Factory
{
    public function couponAmount(int $amount, string $currency = 'usd'): CouponTypeInterface
    {
        return new CouponAmount($amount, $currency);
    }

    public function couponPercent()
    {

    }

    public function durationForever()
    {

    }

    public function durationOnce()
    {

    }

    public function durationRepeating()
    {

    }

    public function fileBusinessLogo()
    {

    }

    public function fileCustomerSignature()
    {

    }

    public function fileDisputeEvidence()
    {

    }

    public function fileIdentityDocument()
    {

    }

    public function filePciDocument()
    {

    }

    public function fileTaxDocumentUserUpload()
    {

    }

    public function invoiceItemAmount()
    {

    }

    public function invoiceItemQuantity()
    {

    }

    public function productGood()
    {

    }

    public function productService()
    {

    }

    public function subscriptionChargeAutomatically()
    {

    }

    public function subscriptionInvoice()
    {

    }
}
