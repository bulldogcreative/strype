<?php

namespace Bulldog\Strype\Resources\Coupons\Type;

use Bulldog\Strype\Contracts\Resources\CouponTypeInterface;

class Amount implements CouponTypeInterface
{
    protected $amount;
    protected $currency;

    public function __construct($amount, $currency = 'usd')
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getCouponType()
    {
        return [
            'amount_off' => $this->amount,
            'currency' => $this->currency,
        ];
    }
}
