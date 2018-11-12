<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

class DiscountTests extends TestCase
{
    public $strype;
    public $id;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
        $this->id = new ObjectId();
    }

    /**
     * @expectedException \Stripe\Error\InvalidRequest
     */
    public function testDeleteCustomerDiscountWithNoDiscount()
    {
        $newCustomer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $customer = $this->strype->customer()->retrieve($newCustomer->getCustomerId());
        $discount = $this->strype->discount()->deleteCustomerDiscount($customer);
    }

    public function testDeleteCustomerDiscount()
    {
        $duration = new \Bulldog\Strype\Resources\Coupons\Duration\Forever();
        $type = new \Bulldog\Strype\Resources\Coupons\Type\Amount(1000, 'usd');
        $coupon = $this->strype->coupon()->create($duration, $type, [], $this->id->get(12));

        $newCustomer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard', [
            'coupon' => $coupon->getId(),
        ]);
        $customer = $this->strype->customer()->retrieve($newCustomer->getCustomerId());
        $discount = $this->strype->discount()->deleteCustomerDiscount($customer);

        $customer = $this->strype->customer()->retrieve($newCustomer->getCustomerId());
        $this->assertEquals($customer->discount, null);
    }
}
