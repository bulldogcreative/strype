<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Contracts\Resources\UsageRecordInterface;
use Bulldog\Strype\Contracts\Resources\SubscriptionItemInterface;

/**
 * Usage records allow you to report customer usage and metrics to Stripe for
 * metered billing of subscription plans.
 *
 * @see https://stripe.com/docs/api/usage_records
 */
class UsageRecord extends Resource implements UsageRecordInterface
{
    /**
     * Creates a usage record for a specified subscription item and date, and
     * fills it with a quantity.
     *
     * @see https://stripe.com/docs/api/usage_records/create
     *
     * @param int                       $quantity
     * @param SubscriptionItemInterface $subscriptionItem
     * @param int                       $timestamp
     * @param array                     $arguments
     * @param string                    $key
     *
     * @return UsageRecordInterface
     */
    public function create(int $quantity, SubscriptionItemInterface $subscriptionItem, int $timestamp, array $arguments = [], string $key = null): UsageRecordInterface
    {
        $arguments['quantity'] = $quantity;
        $arguments['subscription_item'] = $subscriptionItem->getId();
        $arguments['timestamp'] = $timestamp;
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    /**
     * For the specified subscription item, returns a list of summary objects.
     * Each object in the list provides usage information that’s been summarized
     * from multiple usage records and over a subscription billing period (e.g.,
     * 15 usage records in the billing plan’s month of September).
     *
     * @see https://stripe.com/docs/api/usage_records/subscription_item_summary_list
     *
     * @param SubscriptionItemInterface $subscriptionItem
     * @param array                     $arguments
     *
     * @return UsageRecordInterface
     */
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
