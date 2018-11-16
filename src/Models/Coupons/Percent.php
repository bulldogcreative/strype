<?php

namespace Bulldog\Strype\Models\Coupons;

use Bulldog\Strype\Contracts\Models\CouponTypeInterface;

class Percent implements CouponTypeInterface
{
    protected $percentage;
    protected $currency;

    public function __construct(int $percentage, string $currency = 'usd')
    {
        if ($percentage > 100 || 0 > $percentage) {
            throw new \InvalidArgumentException('A positive float larger than 0, and smaller or equal to 100');
        }

        $this->percentage = $percentage;
        $this->currency = $currency;
    }

    public function toArray(): array
    {
        return [
            'percent_off' => $this->percentage,
            'currency' => $this->currency,
        ];
    }
}
