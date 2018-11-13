<?php

namespace Bulldog\Strype\Contracts\Requests;

interface SubscriptionItemInterface
{
    public function create(PlanInterface $plan, SubscriptionInterface $subscription, array $arguments = [], $key = null);
}
