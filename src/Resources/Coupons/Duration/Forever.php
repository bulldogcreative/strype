<?php

declare(strict_types=1);

namespace Bulldog\Strype\Resources\Coupons\Duration;

use Bulldog\Strype\Contracts\Resources\CouponDurationInterface;

class Forever implements CouponDurationInterface
{
    public function getCouponData(): array
    {
        return ['duration' => 'forever'];
    }
}
