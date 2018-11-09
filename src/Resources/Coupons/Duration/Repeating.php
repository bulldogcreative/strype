<?php

namespace Bulldog\Strype\Resources\Coupons\Duration;

use Bulldog\Strype\Contracts\Resources\CouponDurationInterface;

class Repeating implements CouponDurationInterface
{
    protected $durationInMonths;

    public function __construct($durationInMonths)
    {
        $this->durationInMonths = $durationInMonths;
    }

    public function getCouponData()
    {
        return [
            'duration' => 'repeating',
            'duration_in_months' => $this->durationInMonths,
        ];
    }
}
