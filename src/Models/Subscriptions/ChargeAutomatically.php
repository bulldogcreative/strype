<?php

namespace Bulldog\Strype\Models\Subscriptions;

use Bulldog\Strype\Contracts\Models\SubscriptionBillingTypeInterface;

class ChargeAutomatically implements SubscriptionBillingTypeInterface
{
    public function toArray(): array
    {
        return [
            'billing' => 'charge_automatically',
        ];
    }
}
