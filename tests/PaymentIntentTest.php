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

    public function testRetrievePaymentIntent()
    {
        $pi = $this->strype->paymentIntent()->create(
            ['card'],
            9999
        );

        $response = $pi->retrieve($pi->id);
        $this->assertEquals('payment_intent', $response->object);
        $this->assertEquals('succeeded', $response->status);
    }

    public function testUpdatePaymentIntent()
    {
        $pi = $this->strype->paymentIntent()->create(
            ['card'],
            9999
        );

        $response = $pi->update($pi->id, [
            'description' => 'description',
        ]);
        $this->assertEquals('payment_intent', $response->object);
        $this->assertEquals('succeeded', $response->status);
        $this->assertEquals('description', 'description');
    }
}
