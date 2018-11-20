<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\ResourceInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Models\SubscriptionBillingTypeInterface;

interface SubscriptionInterface extends ResourceInterface, RetrieveInterface, UpdateInterface, ListAllInterface
{
    public function create(CustomerInterface $customer, SubscriptionBillingTypeInterface $billing, array $items = [], array $arguments = [], string $key = null): SubscriptionInterface;

    public function cancel(string $id): SubscriptionInterface;
}
