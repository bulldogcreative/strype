<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\ResourceInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;

interface PaymentIntentInterface extends ResourceInterface, RetrieveInterface, UpdateInterface, ListAllInterface
{
    public function create(array $allowedSourceTypes, int $amount, array $arguments = [], string $key = null, string $currency = 'usd'): PaymentIntentInterface;

    public function confirm(string $id, array $arguments = []): PaymentIntentInterface;

    public function capture(string $id, array $arguments = []): PaymentIntentInterface;

    public function cancel(string $id, array $arguments = []): PaymentIntentInterface;
}
