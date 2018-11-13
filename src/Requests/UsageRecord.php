<?php

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Request;
use Bulldog\Strype\Contracts\Requests\SubscriptionItemInterface;
use Bulldog\Strype\Contracts\Requests\UsageRecordInterface;

class UsageRecord extends Request implements UsageRecordInterface
{
    public function create(int $quantity, SubscriptionItemInterface $subscriptionItem, int $timestamp, array $arguments = [], string $key = null)
    {
        $arguments['quantity'] = $quantity;
        $arguments['subscription_item'] = $subscriptionItem->getId();
        $arguments['timestamp'] = $timestamp;
        $this->stripe('create', $arguments, $key);

        return $this;
    }
}
