<?php



namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\Models\CouponTypeInterface;
use Bulldog\Strype\Contracts\Models\DurationTypeInterface;

interface CouponInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function create(DurationTypeInterface $duration, CouponTypeInterface $type, array $arguments = [], string $key = null): CouponInterface;
}
