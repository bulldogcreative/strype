<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Resources;

interface SubscriptionBillingInterface
{
    public function getBilling(): array;
}
