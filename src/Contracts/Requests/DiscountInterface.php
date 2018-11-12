<?php

namespace Bulldog\Strype\Contracts\Requests;

interface DiscountInterface
{
    public function deleteCustomerDiscount(CustomerInterface $customerid);

    public function deleteSubscriptionDiscount(SubscriptionInterface $subscription, $key = null);
}
