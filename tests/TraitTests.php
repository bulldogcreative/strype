<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

class TraitTests extends TestCase
{
    public $strype;
    public $id;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
        $this->id = new ObjectId();
    }

    public function testDeleteTrait()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_visa');
        $result = $customer->delete($customer->getId());
        $this->assertTrue($result->getResponse()->deleted);
        $this->assertTrue($result->deleted);
    }
}
