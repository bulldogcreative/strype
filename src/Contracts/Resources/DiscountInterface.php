<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Resources;

interface DiscountInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function deleteCustomerDiscount(CustomerInterface $customer, string $key = null): DiscountInterface;

    public function deleteSubscriptionDiscount(SubscriptionInterface $subscription): DiscountInterface;
}
