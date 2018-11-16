<?php

namespace Strype;

class ModelTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testPercentModelException()
    {
        $percent = new \Bulldog\Strype\Models\Coupons\Percent(-5);
    }
}
