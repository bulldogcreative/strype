<?php

namespace Bulldog\Strype\Resources\Coupons\Duration;

use Bulldog\Strype\Contracts\Resources\CouponDurationInterface;

class Repeating implements CouponDurationInterface
{
    protected $durationInMonths;

    public function __construct(int $durationInMonths)
    {
        $this->durationInMonths = $durationInMonths;
    }

    public function getCouponData() : array
    {
        return [
            'duration' => 'repeating',
            'duration_in_months' => $this->durationInMonths,
        ];
    }
}
