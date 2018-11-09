<?php

namespace Bulldog\Strype\Resources\Coupons\Duration;

use Bulldog\Strype\Contracts\Resources\CouponDurationInterface;

class Forever implements CouponDurationInterface
{
    public function getCouponData()
    {
        return ['duration' => 'forever'];
    }
}
