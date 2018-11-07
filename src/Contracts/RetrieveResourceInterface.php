<?php

namespace Bulldog\Strype\Contracts;

interface RetrieveResourceInterface
{
    /**
     * Retrieves the details of an existing resource. You need only supply the
     * unique resource identifier that was returned upon resource creation.
     *
     * @param string $id The identifier of the resource to be retrieved
     */
    public function retrieve($id);
}
