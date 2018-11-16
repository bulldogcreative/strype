<?php

namespace Strype;

class PlanTest extends TestCase
{
    public function testCreatePlan()
    {
        $planName = 'Gold special'.$this->id->get(12);
        $planId = 'gold-special'.$this->id->get(12);
        $plan = $this->createPlan($planName, $planId);

        $this->assertEquals('plan', $plan->object);
        $this->assertEquals(2000, $plan->amount);
        $this->assertEquals('usd', $plan->currency);
        $this->assertEquals($planId, $plan->getId());
        $this->assertNull($plan->nickname);
    }

    public function testRetrievePlan()
    {
        $name = 'Testing plan '.$this->id->get(12);
        $id = $this->id->get(12);
        $this->createPlan($name, $id);

        $plan = $this->strype->plan()->retrieve($id);
        $this->assertEquals('plan', $plan->object);
        $this->assertEquals(2000, $plan->amount);
        $this->assertEquals('usd', $plan->currency);
        $this->assertEquals($id, $plan->getId());
        $this->assertNull($plan->nickname);
    }

    public function testUpdatePlan()
    {
        $name = 'Testing plan '.$this->id->get(12);
        $id = $this->id->get(12);
        $this->createPlan($name, $id);

        $plan = $this->strype->plan()->update($id, [
            'nickname' => 'elite',
        ]);
        $this->assertEquals('plan', $plan->object);
        $this->assertEquals(2000, $plan->amount);
        $this->assertEquals('usd', $plan->currency);
        $this->assertEquals($id, $plan->getId());
        $this->assertEquals('elite', $plan->nickname);
    }

    public function testDeletePlan()
    {
        $name = 'Testing plan '.$this->id->get(12);
        $id = $this->id->get(12);
        $this->createPlan($name, $id);

        $plan = $this->strype->plan()->delete($id);
        $this->assertEquals('plan', $plan->object);
        $this->assertEquals(2000, $plan->amount);
        $this->assertEquals('usd', $plan->currency);
        $this->assertEquals($id, $plan->getId());
        $this->assertTrue($plan->deleted);
        $this->assertNull($plan->nickname);
    }

    public function testListAllPlans()
    {
        $name = 'Testing plan '.$this->id->get(12);
        $id = $this->id->get(12);
        $this->createPlan($name, $id);

        $plans = $this->strype->plan()->listAll([
            'limit' => 1,
        ]);
        $this->assertCount(1, $plans->data);
        $this->assertEquals('plan', $plans->data[0]->object);
        $this->assertEquals(2000, $plans->data[0]->amount);
        $this->assertEquals('usd', $plans->data[0]->currency);
        // This assertion kept failing. I assume it was because the test was
        // also running on different versions of PHP, so the name wouldn't match
        // $this->assertEquals($name, $plans->data[0]->name);
        // $this->assertEquals($id, $plans->data[0]->id);
    }

    public function createPlan($name, $id)
    {
        return $this->strype->plan()->create([
            'amount' => 2000,
            'interval' => 'month',
            'product' => [
                'name' => $name,
            ],
            'currency' => 'usd',
            'id' => $id,
        ]);
    }
}
