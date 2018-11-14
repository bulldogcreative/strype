<?php

declare(strict_types=1);

namespace Bulldog\Strype\Resources\Coupons\Type;

use Bulldog\Strype\Contracts\Resources\CouponTypeInterface;

class Amount implements CouponTypeInterface
{
    protected $amount;
    protected $currency;

    public function __construct(int $amount, string $currency = 'usd')
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getCouponType() : array
    {
        return [
            'amount_off' => $this->amount,
            'currency' => $this->currency,
        ];
    }
}
