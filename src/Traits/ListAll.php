<?php

namespace Bulldog\Strype\Traits;

/**
 * List All.
 */
trait ListAll
{
    /**
     * List all the resources.
     *
     * This will list all of the resources from which this trait belongs to. It
     * will then return itself, so you can method chain it, or reuse the same
     * instantiation.
     *
     * @param array $arguments
     *
     * @return self
     */
    public function listAll(array $arguments = [])
    {
        $this->stripe('all', $arguments);

        return $this;
    }
}
