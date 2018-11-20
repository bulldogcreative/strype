<?php

namespace Bulldog\Strype\Models\Subscriptions;

use Bulldog\Strype\Contracts\Models\SubscriptionBillingTypeInterface;

/**
 * Charge the subscription automatically.
 */
class ChargeAutomatically implements SubscriptionBillingTypeInterface
{
    public function toArray(): array
    {
        return [
            'billing' => 'charge_automatically',
        ];
    }
}
