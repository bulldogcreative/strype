<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\CouponInterface;
use Bulldog\Strype\Contracts\Models\CouponTypeInterface;
use Bulldog\Strype\Contracts\Models\DurationTypeInterface;

/**
 * A coupon contains information about a percent-off or amount-off discount you
 * might want to apply to a customer. Coupons may be applied to invoices or orders.
 * Coupons do not work with conventional one-off charges, but you can implement a
 * custom coupon system in your application.
 *
 * @see https://stripe.com/docs/api/coupons
 */
class Coupon extends Resource implements CouponInterface
{
    use Retrieve, Update, ListAll, Delete;

    /**
     * A coupon has either a percent_off or an amount_off and currency. If you set
     * an amount_off, that amount will be subtracted from any invoice’s subtotal.
     * For example, an invoice with a subtotal of $100 will have a final total of
     * $0 if a coupon with an amount_off of 20000 is applied to it and an invoice
     * with a subtotal of $300 will have a final total of $100 if a coupon with an
     * amount_off of 20000 is applied to it.
     *
     * @see https://stripe.com/docs/api/coupons/create
     *
     * @param DurationTypeInterface $duration
     * @param CouponTypeInterface   $type
     * @param array                 $arguments
     * @param string|null           $key
     *
     * @return CouponInterface
     */
    public function create(DurationTypeInterface $duration, CouponTypeInterface $type, array $arguments = [], string $key = null): CouponInterface
    {
        $arguments = array_merge($arguments, $duration->toArray(), $type->toArray());
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, $idempotencyKey = null): void
    {
        $this->response = \Stripe\Coupon::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
