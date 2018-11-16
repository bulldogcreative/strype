<?php

declare(strict_types=1);

namespace Bulldog\Strype\Resources\Subscriptions;

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
