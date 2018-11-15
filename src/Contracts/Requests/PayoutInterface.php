<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

interface PayoutInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(int $amount, array $arguments = [], string $key = null, string $currency = 'usd'): PayoutInterface;

    public function cancel(string $id): PayoutInterface;
}
