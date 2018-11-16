<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

interface RefundInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function create(ChargeInterface $charge, array $arguments = [], string $key = null): RefundInterface;
}
