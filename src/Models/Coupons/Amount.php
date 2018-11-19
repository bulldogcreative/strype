<?php

namespace Bulldog\Strype\Models\Coupons;

use Bulldog\Strype\Contracts\Models\CouponTypeInterface;

/**
 * Amount class.
 */
class Amount implements CouponTypeInterface
{
    protected $amount;
    protected $currency;

    /**
     * Create an amount object with currency.
     *
     * @param int    $amount   Amount in pennies
     * @param string $currency Three letter currency code
     */
    public function __construct(int $amount, string $currency = 'usd')
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * Return an associative array with the protected properties.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'amount_off' => $this->amount,
            'currency' => $this->currency,
        ];
    }
}
