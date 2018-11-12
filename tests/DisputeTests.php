<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;

class DisputeTests extends TestCase
{
    public $strype;
    public $id;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
        $this->id = new ObjectId();
    }

    public function testListAllDisputes()
    {
        $disputes = $this->strype->dispute()->listAll(['limit' => 3]);
        $this->assertTrue(is_array($disputes->data));
    }

    /**
     * @expectedException \Stripe\Error\InvalidRequest
     */
    public function testRetrieveDistpute()
    {
        $dispute = $this->strype->dispute()->retrieve('abc123');
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

        // Was randomly getting errors during testing on Travis-CI. So we loop
        // through the disputes to find one that needs a response, then we use
        // that dispute for the remainder of this test.
        //
        // https://github.com/bulldogcreative/strype/issues/6
        foreach($disputes->data as $data) {
            if($data->status == "needs_response") {
                $dispute = $data;
            }
        }

        $updated = $this->strype->dispute()->update($dispute->id, [
            'evidence' => [
                'product_description' => 'reindeer tracks',
            ],
        ]);
        $this->assertEquals('reindeer tracks', $updated->evidence['product_description']);
    }

    /**
     * @expectedException \Stripe\Error\InvalidRequest
     */
    public function testCloseDisputeWithException()
    {
        $dispute = $this->strype->dispute()->close('abc123');
    }

    /**
     * @expectedException \Stripe\Error\InvalidRequest
     */
    public function testUpdateDisputeWithException()
    {
        $this->strype->dispute()->update('abc123', ['description' => 'Santa']);
    }
}
