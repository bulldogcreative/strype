<?php

declare(strict_types=1);

namespace Bulldog\Strype\Resources\Coupons\Type;

use Bulldog\Strype\Contracts\Resources\CouponTypeInterface;

class Percentage implements CouponTypeInterface
{
    protected $percentage;

    public function __construct(int $percentage)
    {
        $this->percentage = $percentage;
    }

    public function getCouponType(): array
    {
        return [
            'percent_off' => $this->percentage,
        ];
    }
}
