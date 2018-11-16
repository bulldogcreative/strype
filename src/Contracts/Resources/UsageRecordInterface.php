<?php

namespace Bulldog\Strype\Contracts\Resources;

interface UsageRecordInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function create(int $quantity, SubscriptionItemInterface $subscriptionItem, int $timestamp, array $arguments = [], string $key = null): UsageRecordInterface;

    public function usageRecordSummaries(SubscriptionItemInterface $subscriptionItem, array $arguments = []): UsageRecordInterface;
}
