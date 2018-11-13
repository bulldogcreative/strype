<?php

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Request;
use Bulldog\Strype\Contracts\Requests\SubscriptionItemInterface;

class SubscriptionItem extends Request implements SubscriptionItemInterface
{
    public function create(PlanInterface $plan, SubscriptionInterface $subscription, array $arguments = [], $key = null)
    {

    }
}
