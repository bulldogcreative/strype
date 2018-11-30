<?php

namespace Strype;

class PaymentIntentTest extends TestCase
{
    public function testCreatePaymentIntent()
    {
        $pi = $this->strype->paymentIntent()->create(
            ['card'],
            9999
        );

        $this->assertEquals('payment_intent', $pi->object);
        $this->assertEquals('succeeded', $pi->status);
    }
}
