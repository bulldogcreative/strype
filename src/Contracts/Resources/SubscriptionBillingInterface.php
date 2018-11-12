<?php

namespace Bulldog\Strype\Contracts\Resources;

interface SubscriptionBillingInterface
{
    public function getBilling(): array;
}
