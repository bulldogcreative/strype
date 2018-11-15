<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

/**
 * Interface CustomerInterface.
 */
interface ChargeInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(CustomerInterface $customer, int $amount, array $arguments = [], string $key = null, string $currency = 'usd'): ChargeInterface;

    public function capture(string $id = null): ChargeInterface;
}
