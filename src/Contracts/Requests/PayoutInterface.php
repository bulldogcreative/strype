<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

interface PayoutInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(int $amount, $arguments = [], $key = null, string $currency = 'usd');

    public function cancel(string $id);
}
