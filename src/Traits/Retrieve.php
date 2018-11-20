<?php

namespace Bulldog\Strype\Traits;

/**
 * Retrieve.
 */
trait Retrieve
{
    /**
     * Get a resource by the ID.
     *
     * @param string $id
     *
     * @return self
     */
    public function retrieve(string $id)
    {
        $this->stripe('retrieve', $id);

        return $this;
    }
}
