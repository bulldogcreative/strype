<?php

namespace Bulldog\Strype\Resources\Coupons\Duration;

use Bulldog\Strype\Contracts\Resources\CouponDurationInterface;

class Once implements CouponDurationInterface
{
    public function getCouponData()
    {
        return ['duration' => 'once'];
    }
}
