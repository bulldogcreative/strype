<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Resources\CouponInterface;
use Bulldog\Strype\Contracts\Models\CouponTypeInterface;
use Bulldog\Strype\Contracts\Models\DurationTypeInterface;

/**
 * Class Coupon.
 *
 * A coupon contains information about a percent-off or amount-off discount you
 * might want to apply to a customer. Coupons may be applied to invoices or orders.
 * Coupons do not work with conventional one-off charges, but you can implement a
 * custom coupon system in your application.
 *
 * @see https://stripe.com/docs/api/coupons
 */
class Coupon extends Resource implements CouponInterface, RetrieveInterface, UpdateInterface, ListAllInterface, DeleteInterface
{
    use Retrieve, Update, ListAll, Delete;

    /**
     * Create a coupon.
     *
     * You can create coupons easily via the coupon management page of the Stripe
     * dashboard. Coupon creation is also accessible via the API if you need to
     * create coupons on the fly.
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
