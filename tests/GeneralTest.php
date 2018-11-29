<?php

namespace Strype;

class GeneralTest extends TestCase
{
    public function testCustomerImplementsInterfaces()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_mastercard');
        $this->assertTrue($customer instanceof \Bulldog\Strype\Contracts\Support\Identifiable);
        $this->assertTrue($customer instanceof \Bulldog\Strype\Contracts\ResourceInterface);
        $this->assertTrue($customer instanceof \Bulldog\Strype\Contracts\Traits\DeleteInterface);
        $this->assertTrue($customer instanceof \Bulldog\Strype\Contracts\Traits\UpdateInterface);
        $this->assertTrue($customer instanceof \Bulldog\Strype\Contracts\Traits\ListAllInterface);
        $this->assertTrue($customer instanceof \Bulldog\Strype\Contracts\Traits\RetrieveInterface);
    }
}
