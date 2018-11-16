<?php

namespace Bulldog\Strype\Contracts\Resources;

interface CustomerInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function create(string $email, string $token, array $arguments = [], string $key = null): CustomerInterface;
}
