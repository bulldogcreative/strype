<?php

namespace Strype;

class EventTest extends TestCase
{
    const TEST_RESOURCE_ID = 'evt_123';

    public function testListAllAndRetrieveEvents()
    {
        $this->expectsRequest(
            'get',
            '/v1/events'
        );

        $events = $this->strype->event()->listAll(['limit' => 1]);
        $this->assertEquals(1, count($events->data));
        $this->assertTrue(is_array($events->data));
        $this->assertInstanceOf("Stripe\\Event", $events->data[0]);
    }

    public function testRetrieveEvent()
    {
        $this->expectsRequest(
            'get',
            '/v1/events/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->strype->event()->retrieve(self::TEST_RESOURCE_ID)->getResponse();
        $this->assertInstanceOf("Stripe\\Event", $resource);
    }
}
