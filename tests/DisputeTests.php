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
     * @expectedException Stripe\Error\InvalidRequest
     */
    public function testRetrieveDistpute()
    {
        $dispute = $this->strype->dispute()->retrieve('abc123');
    }

    /**
     * @expectedException Stripe\Error\InvalidRequest
     */
    public function testCloseDispute()
    {
        $dispute = $this->strype->dispute()->close('abc123');
    }

    /**
     * @expectedException Stripe\Error\InvalidRequest
     */
    public function testUpdateDispute()
    {
        $this->strype->dispute()->update('abc123', ['description' => 'Santa']);
    }
}
