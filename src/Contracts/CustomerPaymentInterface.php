<?php

namespace Bulldog\Strype\Contracts;

interface CustomerPaymentInterface
{
    /**
     * Get the Customer ID.
     *
     * Implemented for CustomerPaymentInterface
     *
     * @return string
     */
    public function getCustomerId(): string;
}
