<?php

namespace Bulldog\Strype\Contracts\Requests;

/**
 * Interface CustomerInterface.
 */
interface CustomerInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    /**
     * @param string $email
     * @param string $token
     *
     * @return mixed
     */
    public function create(string $email, string $token, $key = null);

    /**
     * @return mixed
     */
    public function getCustomerId(): string;
}
