<?php

namespace Bulldog\Strype\Contracts\Requests;

interface UsageRecordInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(int $quantity, SubscriptionItemInterface $subscriptionItem, int $timestamp, array $arguments = [], string $key = null);
}
