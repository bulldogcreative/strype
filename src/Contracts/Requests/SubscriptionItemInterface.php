<?php

namespace Bulldog\Strype\Contracts\Requests;

interface SubscriptionItemInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(PlanInterface $plan, SubscriptionInterface $subscription, array $arguments = [], $key = null);
}
