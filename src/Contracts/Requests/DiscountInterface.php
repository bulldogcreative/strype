<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

interface DiscountInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function deleteCustomerDiscount(CustomerInterface $customer, string $key = null): DiscountInterface;

    public function deleteSubscriptionDiscount(SubscriptionInterface $subscription): DiscountInterface;
}
