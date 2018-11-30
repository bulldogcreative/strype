<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\ResourceInterface;

interface PaymentIntentInterface extends ResourceInterface
{
    public function create(array $allowedSourceTypes, int $amount, array $arguments = [], string $key = null, string $currency = 'usd'): PaymentIntentInterface;

    public function confirm(string $id): PaymentIntentInterface;

    public function capture(string $id): PaymentIntentInterface;

    public function cancel(string $id): PaymentIntentInterface;
}
