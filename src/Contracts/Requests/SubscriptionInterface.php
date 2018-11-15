<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

use Bulldog\Strype\Contracts\Resources\SubscriptionBillingInterface;

interface SubscriptionInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(CustomerInterface $customer, SubscriptionBillingInterface $billing, array $items = [], array $arguments = [], string $key = null): SubscriptionInterface;

    public function cancel($id): SubscriptionInterface;
}
