<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

class PlanTests extends TestCase
{
    public $strype;
    public $id;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
        $this->id = new ObjectId();
    }

    public function testCreatePlan()
    {
        $planName = "Gold special" . $this->id->get(12);
        $planId = "gold-special" . $this->id->get(12);
        $plan = $this->strype->plan()->create([
            "amount" => 5000,
            "interval" => "month",
            "product" => [
                "name" => $planName
            ],
            "currency" => "usd",
            "id" => $planId
        ]);

        $this->assertEquals('plan', $plan->object);
        $this->assertEquals(5000, $plan->amount);
        $this->assertEquals('usd', $plan->currency);
        $this->assertEquals($planName, $plan->name);
        $this->assertEquals($planId, $plan->getId());
    }
}
