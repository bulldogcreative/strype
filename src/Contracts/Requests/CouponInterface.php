<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

use Bulldog\Strype\Contracts\Models\DurationInterface;
use Bulldog\Strype\Contracts\Resources\CouponTypeInterface;

interface CouponInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(DurationInterface $duration, CouponTypeInterface $type, array $arguments = [], string $key = null): CouponInterface;
}
