<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\ResourceInterface;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;

interface SubscriptionItemInterface extends ResourceInterface, RetrieveInterface, UpdateInterface, DeleteInterface, ListAllInterface
{
    public function create(PlanInterface $plan, SubscriptionInterface $subscription, array $arguments = [], string $key = null): SubscriptionItemInterface;
}
