<?php

namespace Bulldog\Strype\Resources\Coupons\Type;

use Bulldog\Strype\Contracts\Resources\CouponTypeInterface;

class Percentage implements CouponTypeInterface
{
    protected $percentage;

    public function __construct($percentage)
    {
        $this->percentage = $percentage;
    }

    public function getCouponType()
    {
        return [
            'percent_off' => $this->percentage,
        ];
    }
}
