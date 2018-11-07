<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;

class EventTests extends TestCase
{
    public $strype;
    public $customer;
    public $id;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
    }

    public function testListAllAndRetrieveEvents()
    {
        $events = $this->strype->event()->listAll(['limit' => 3]);
        $this->assertEquals(3, count($events->data));
        foreach ($events->data as $data) {
            $event = $this->strype->event()->retrieve($data->id);
            $this->assertEquals($data->id, $event->getId());
        }
    }
}
