<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

/**
 * Interface CustomerInterface.
 */
interface ChargeInterface
{
    public function create(CustomerInterface $customer, int $amount, array $arguments = [], $key = null, string $currency = 'usd');

    public function capture(string $id);

    public function getId();
}
