<?php

namespace Bulldog\Strype\Contracts\Requests;

interface DiscountInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function deleteCustomerDiscount(CustomerInterface $customerid);

    public function deleteSubscriptionDiscount(SubscriptionInterface $subscription);
}
