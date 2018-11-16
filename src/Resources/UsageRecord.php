<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Contracts\Requests\SubscriptionItemInterface;
use Bulldog\Strype\Contracts\Requests\UsageRecordInterface;
use Bulldog\Strype\Request;

class UsageRecord extends Request implements UsageRecordInterface
{
    public function create(int $quantity, SubscriptionItemInterface $subscriptionItem, int $timestamp, array $arguments = [], string $key = null): UsageRecordInterface
    {
        $arguments['quantity'] = $quantity;
        $arguments['subscription_item'] = $subscriptionItem->getId();
        $arguments['timestamp'] = $timestamp;
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    public function usageRecordSummaries(SubscriptionItemInterface $subscriptionItem, array $arguments = []): UsageRecordInterface
    {
        $this->response = \Stripe\SubscriptionItem::retrieve($subscriptionItem->getId());
        $this->setProperties();
        $this->response = $this->response->usageRecordSummaries($arguments);

        return $this;
    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null)
    {
        $this->response = \Stripe\UsageRecord::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}