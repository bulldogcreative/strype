<?php

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Request;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Resources\CouponDurationInterface;
use Bulldog\Strype\Contracts\Resources\CouponTypeInterface;
use Bulldog\Strype\Contracts\Requests\CouponInterface;

class Coupon extends Request implements CouponInterface, RetrieveInterface, UpdateInterface, ListAllInterface, DeleteInterface
{
    use Retrieve, Update, ListAll, Delete;

    public function create(CouponDurationInterface $duration, CouponTypeInterface $type, array $arguments = [], $key = null)
    {
        $arguments = array_merge($arguments, $duration->getCouponData(), $type->getCouponType());
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, $idempotencyKey = null)
    {
        $this->response = \Stripe\Coupon::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
