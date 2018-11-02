<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;

class CustomerTests extends TestCase
{
    public $strype;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
    }
}
