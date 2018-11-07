<?php

namespace Bulldog\Strype\Traits\Resources;

trait RetrieveResource
{
    /**
     * Retrieves the details of an existing resource. You need only supply the
     * unique resource identifier that was returned upon resource creation.
     *
     * @param string $id The identifier of the resource to be retrieved
     */
    public function retrieve($id)
    {
        $this->stripe('retrieve', $id);

        return $this;
    }
}
