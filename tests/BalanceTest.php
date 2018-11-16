<?php

namespace Strype;

use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

class BalanceTest extends TestCase
{
    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/v1/balance'
        );
        $resource = $this->strype->balance()->retrieveBalance()->getResponse();
        $this->assertInstanceOf("Stripe\\Balance", $resource);
        $this->assertFalse($resource->livemode);
        $this->assertEquals('balance', $resource->object);
    }

    public function testRetrieveBalanceTransaction()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_visa', [], $this->id->get(12));
        $charge = $this->strype->charge()->create($customer, 100, [], $this->id->get(12));
        $balance = $this->strype->balance()->retrieve($charge->balance_transaction);
        $this->assertEquals(100, $balance->amount);
    }
}
