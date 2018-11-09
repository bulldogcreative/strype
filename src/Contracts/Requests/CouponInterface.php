<?php

namespace Bulldog\Strype\Contracts\Requests;

use Bulldog\Strype\Contracts\Resources\CouponDurationInterface;
use Bulldog\Strype\Contracts\Resources\CouponTypeInterface;

interface CouponInterface
{
    public function create(CouponDurationInterface $duration, CouponTypeInterface $type, array $arguments = [], $key = null);
}
