<?php

namespace Bulldog\Strype\Models\Subscriptions;

use Bulldog\Strype\Contracts\Models\SubscriptionBillingTypeInterface;

class SendInvoice implements SubscriptionBillingTypeInterface
{
    protected $daysUntilDue;

    public function __construct(int $daysUntilDue)
    {
        $this->daysUntilDue = $daysUntilDue;
    }

    public function toArray(): array
    {
        return [
            'billing' => 'send_invoice',
            'days_until_due' => $this->daysUntilDue,
        ];
    }
}
