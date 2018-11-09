<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

class CouponTests extends TestCase
{
    public $strype;
    public $id;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
        $this->id = new ObjectId();
    }

    public function testResourceCouponDurations()
    {
        $forever = new \Bulldog\Strype\Resources\Coupons\Duration\Forever();
        $once = new \Bulldog\Strype\Resources\Coupons\Duration\Once();
        $repeating = new \Bulldog\Strype\Resources\Coupons\Duration\Repeating(12);

        $this->assertEquals('forever', $forever->getCouponData()['duration']);
        $this->assertEquals('once', $once->getCouponData()['duration']);
        $this->assertEquals('repeating', $repeating->getCouponData()['duration']);
        $this->assertEquals(12, $repeating->getCouponData()['duration_in_months']);
    }

    public function testResourceCouponTypes()
    {
        $amount = (new \Bulldog\Strype\Resources\Coupons\Type\Amount(1000, 'usd'))->getCouponType();
        $this->assertEquals(1000, $amount['amount_off']);
        $this->assertEquals('usd', $amount['currency']);

        $percentage = (new \Bulldog\Strype\Resources\Coupons\Type\Percentage(10))->getCouponType();
        $this->assertEquals(10, $percentage['percent_off']);
    }

    public function testCreateCoupon()
    {
        $duration = new \Bulldog\Strype\Resources\Coupons\Duration\Forever();
        $type = new \Bulldog\Strype\Resources\Coupons\Type\Amount(1000, 'usd');
        $coupon = $this->strype->coupon()->create($duration, $type, [], $this->id->get(12));
        $this->assertEquals('coupon', $coupon->object);
        $this->assertEquals('forever', $coupon->duration);
        $this->assertEquals(1000, $coupon->amount_off);
        $this->assertEquals('usd', $coupon->currency);
    }

    public function testCreateCouponForeverAndPercent()
    {
        $duration = new \Bulldog\Strype\Resources\Coupons\Duration\Forever();
        $type = new \Bulldog\Strype\Resources\Coupons\Type\Percentage(10);
        $coupon = $this->strype->coupon()->create($duration, $type, [], $this->id->get(12));
        $this->assertEquals('coupon', $coupon->object);
        $this->assertEquals(10, $coupon->percent_off);
    }

    public function testCreateCouponForeverAndAmount()
    {
        $duration = new \Bulldog\Strype\Resources\Coupons\Duration\Forever();
        $type = new \Bulldog\Strype\Resources\Coupons\Type\Amount(1000, 'usd');
        $coupon = $this->strype->coupon()->create($duration, $type, [], $this->id->get(12));
        $this->assertEquals('coupon', $coupon->object);
        $this->assertEquals(1000, $coupon->amount_off);
        $this->assertEquals('usd', $coupon->currency);
    }

    public function testCreateCouponOnceAndPercent()
    {
        $duration = new \Bulldog\Strype\Resources\Coupons\Duration\Once();
        $type = new \Bulldog\Strype\Resources\Coupons\Type\Percentage(10);
        $coupon = $this->strype->coupon()->create($duration, $type, [], $this->id->get(12));
        $this->assertEquals('coupon', $coupon->object);
        $this->assertEquals(10, $coupon->percent_off);
    }

    public function testCreateCouponOnceAndAmount()
    {
        $duration = new \Bulldog\Strype\Resources\Coupons\Duration\Once();
        $type = new \Bulldog\Strype\Resources\Coupons\Type\Amount(1000, 'usd');
        $coupon = $this->strype->coupon()->create($duration, $type, [], $this->id->get(12));
        $this->assertEquals('coupon', $coupon->object);
        $this->assertEquals(1000, $coupon->amount_off);
        $this->assertEquals('usd', $coupon->currency);
    }

    public function testCreateCouponRepeatAndPercent()
    {
        $duration = new \Bulldog\Strype\Resources\Coupons\Duration\Repeating(12);
        $type = new \Bulldog\Strype\Resources\Coupons\Type\Percentage(10);
        $coupon = $this->strype->coupon()->create($duration, $type, [], $this->id->get(12));
        $this->assertEquals('coupon', $coupon->object);
        $this->assertEquals(10, $coupon->percent_off);
        $this->assertEquals(12, $coupon->duration_in_months);
    }

    public function testCreateCouponRepeatAndAmount()
    {
        $duration = new \Bulldog\Strype\Resources\Coupons\Duration\Repeating(12);
        $type = new \Bulldog\Strype\Resources\Coupons\Type\Amount(1000, 'usd');
        $coupon = $this->strype->coupon()->create($duration, $type, [], $this->id->get(12));
        $this->assertEquals('coupon', $coupon->object);
        $this->assertEquals(1000, $coupon->amount_off);
        $this->assertEquals('usd', $coupon->currency);
        $this->assertEquals(12, $coupon->duration_in_months);
    }

    public function testRetrieveCoupon()
    {
        $duration = new \Bulldog\Strype\Resources\Coupons\Duration\Repeating(12);
        $type = new \Bulldog\Strype\Resources\Coupons\Type\Amount(1000, 'usd');
        $coupon = $this->strype->coupon()->create($duration, $type, [], $this->id->get(12));

        $retrieved = $this->strype->coupon()->retrieve($coupon->getId());
        $this->assertEquals('coupon', $retrieved->object);
        $this->assertEquals(1000, $retrieved->amount_off);
        $this->assertEquals('usd', $retrieved->currency);
        $this->assertEquals(12, $retrieved->duration_in_months);
    }

    public function testUpdateCoupon()
    {
        $duration = new \Bulldog\Strype\Resources\Coupons\Duration\Repeating(12);
        $type = new \Bulldog\Strype\Resources\Coupons\Type\Amount(1000, 'usd');
        $coupon = $this->strype->coupon()->create($duration, $type, [], $this->id->get(12));
        $coupon->update($coupon->getId(), ['metadata' => ['order_id' => '6735']]);

        $retrieved = $this->strype->coupon()->retrieve($coupon->getId());
        $this->assertEquals('coupon', $retrieved->object);
        $this->assertEquals(1000, $retrieved->amount_off);
        $this->assertEquals('usd', $retrieved->currency);
        $this->assertEquals(12, $retrieved->duration_in_months);
    }

    public function testDeleteCoupon()
    {
        $duration = new \Bulldog\Strype\Resources\Coupons\Duration\Repeating(12);
        $type = new \Bulldog\Strype\Resources\Coupons\Type\Amount(1000, 'usd');
        $coupon = $this->strype->coupon()->create($duration, $type, [], $this->id->get(12));
        $coupon->delete($coupon->getId());

        $this->assertTrue($coupon->deleted);
    }

    public function testListAllCoupons()
    {
        $coupons = $this->strype->coupon()->listAll(['limit' => 3]);
        $this->assertEquals(3, count($coupons->data));
    }
}
