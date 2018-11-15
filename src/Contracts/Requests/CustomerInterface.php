<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

/**
 * Interface CustomerInterface.
 */
interface CustomerInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(string $email, string $token, array $arguments = [], string $key = null): CustomerInterface;
}
