<?php

namespace Bulldog\Strype\Contracts\Resources;

/**
 * Interface CustomerInterface.
 */
interface ChargeInterface
{
    public function create(CustomerInterface $customer, int $amount, array $arguments = [], $key = null, string $currency = 'usd');

    public function capture(string $id);

    public function getId();
}
