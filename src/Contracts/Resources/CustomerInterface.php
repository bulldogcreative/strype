<?php

namespace Bulldog\Strype\Contracts\Resources;

/**
 * Interface CustomerInterface.
 */
interface CustomerInterface
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
