<?php

namespace Bulldog\Strype\Resources\Subscriptions;

use Bulldog\Strype\Contracts\Resources\SubscriptionBillingInterface;

class SendInvoice implements SubscriptionBillingInterface
{
    public $daysUntilDue;

    public function __construct($daysUntilDue)
    {
        $this->daysUntilDue = $daysUntilDue;
    }

    public function getBilling(): array
    {
        return [
            'billing' => 'send_invoice',
            'days_until_due' => $this->daysUntilDue,
        ];
    }
}
