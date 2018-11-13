<?php

namespace Bulldog\Strype\Contracts\Requests;

use Bulldog\Strype\Contracts\Resources\SubscriptionBillingInterface;

interface SubscriptionInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(CustomerInterface $customer, SubscriptionBillingInterface $billing, array $items = [], array $arguments = [], $key = null);

    public function cancel($id);
}
