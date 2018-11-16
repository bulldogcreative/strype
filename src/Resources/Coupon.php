<?php

declare(strict_types=1);

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Contracts\Models\CouponTypeInterface;
use Bulldog\Strype\Contracts\Models\DurationTypeInterface;
use Bulldog\Strype\Contracts\Requests\CouponInterface;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;

class Coupon extends Resource implements CouponInterface, RetrieveInterface, UpdateInterface, ListAllInterface, DeleteInterface
{
    use Retrieve, Update, ListAll, Delete;

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
