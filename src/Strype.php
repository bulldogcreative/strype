<?php

namespace Bulldog\Strype;

class Strype
{
    public function __construct($apikey)
    {
        \Stripe\Stripe::setApiKey($apikey);
    }
}
