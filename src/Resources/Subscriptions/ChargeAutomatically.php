<?php

declare(strict_types=1);

namespace Bulldog\Strype\Resources\Subscriptions;

use Bulldog\Strype\Contracts\Resources\SubscriptionBillingInterface;

class ChargeAutomatically implements SubscriptionBillingInterface
{
    public function getBilling(): array
    {
        return [
            'billing' => 'charge_automatically',
        ];
    }
}
