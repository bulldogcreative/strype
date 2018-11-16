<?php

namespace Bulldog\Strype\Contracts\Resources;

interface SubscriptionItemInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function create(PlanInterface $plan, SubscriptionInterface $subscription, array $arguments = [], string $key = null): SubscriptionItemInterface;
}
