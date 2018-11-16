<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

use Bulldog\Strype\Contracts\Models\SubscriptionBillingTypeInterface;

interface SubscriptionInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function create(CustomerInterface $customer, SubscriptionBillingTypeInterface $billing, array $items = [], array $arguments = [], string $key = null): SubscriptionInterface;

    public function cancel($id): SubscriptionInterface;
}
