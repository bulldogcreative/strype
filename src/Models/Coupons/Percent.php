<?php

namespace Bulldog\Strype\Models\Coupons;

use Bulldog\Strype\Contracts\Models\CouponTypeInterface;

/**
 * A Percent object only requires the percentage.
 */
class Percent implements CouponTypeInterface
{
    protected $percentage;
    protected $currency;

    /**
     * Create a percent object with currency.
     *
     * The percentage must be a int greater than 0 and less than 100.
     *
     * @param int    $percentage
     * @param string $currency
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(int $percentage, string $currency = 'usd')
    {
        if ($percentage > 100 || 0 > $percentage) {
            throw new \InvalidArgumentException('A positive float larger than 0, and smaller or equal to 100');
        }

        $this->percentage = $percentage;
        $this->currency = $currency;
    }

    /**
     * Return an associative array with the values of the properties.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'percent_off' => $this->percentage,
            'currency' => $this->currency,
        ];
    }
}
