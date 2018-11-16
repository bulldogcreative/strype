<?php

namespace Bulldog\Strype\Models\Coupons;

use Bulldog\Strype\Contracts\Models\CouponTypeInterface;

class Amount implements CouponTypeInterface
{
    protected $amount;
    protected $currency;

    public function __construct(int $amount, string $currency = 'usd')
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function toArray(): array
    {
        return [
            'amount_off' => $this->amount,
            'currency' => $this->currency,
        ];
    }
}
