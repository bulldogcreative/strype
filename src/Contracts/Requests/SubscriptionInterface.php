<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

use Bulldog\Strype\Contracts\Resources\SubscriptionBillingInterface;

interface SubscriptionInterface
{
    public function create(CustomerInterface $customer, SubscriptionBillingInterface $billing, array $items = [], array $arguments = [], $key = null);

    public function cancel($id);
}
