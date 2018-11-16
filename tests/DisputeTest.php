<?php

namespace Strype;

class DisputeTest extends TestCase
{
    const TEST_RESOURCE_ID = 'dp_123';

    public function testListAllDisputes()
    {
        $disputes = $this->strype->dispute()->listAll(['limit' => 3]);
        $this->assertTrue(is_array($disputes->data));
    }

    public function testRetrieveDistpute()
    {
        $this->expectsRequest(
            'get',
            '/v1/disputes/' . self::TEST_RESOURCE_ID
        );

        $dispute = $this->strype->dispute()->retrieve(self::TEST_RESOURCE_ID);
        $this->assertInstanceOf("Stripe\\Dispute", $dispute->getResponse());
    }

    public function testCloseDispute()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_createDispute');
        $charge = $this->strype->charge()->create($customer, 500, [], $this->id->get(12));

        $disputes = $this->strype->dispute()->listAll(['limit' => 1]);
        $this->assertEquals('dispute', $disputes->getResponse()->data[0]->object);
        $result = $this->strype->dispute()->close($disputes->data[0]->id);
        $this->assertEquals('needs_response', $result->status);
    }

    public function testUpdateDispute()
    {
        $customer = $this->strype->customer()->create('levi@example.com', 'tok_createDispute');
        $charge = $this->strype->charge()->create($customer, 500, [], $this->id->get(12));
        $disputes = $this->strype->dispute()->listAll();
        $dispute = $disputes->data[0];

        $updated = $this->strype->dispute()->update($dispute->id, [
            'evidence' => [
                'product_description' => 'reindeer tracks',
            ],
        ]);
        $this->assertEquals('reindeer tracks', $updated->evidence['product_description']);
    }
}
