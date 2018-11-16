<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\Models\SubscriptionBillingTypeInterface;

interface SubscriptionInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function create(CustomerInterface $customer, SubscriptionBillingTypeInterface $billing, array $items = [], array $arguments = [], string $key = null): SubscriptionInterface;

    public function cancel($id): SubscriptionInterface;
}
