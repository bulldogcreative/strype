<?php

namespace Bulldog\Strype\Traits;

/**
 * Delete.
 */
trait Delete
{
    /**
     * Delete a resource.
     *
     * Delete a resource associated with the class this trait is being used. You
     * must pass in the ID of the resource that you wish to delete. Then it will
     * return the same instance of the class from which it was called.
     *
     * @param string $id
     *
     * @return self
     */
    public function delete(string $id)
    {
        $this->stripe('retrieve', $id);
        $this->response->delete();
        $this->deleted = true;

        return $this;
    }
}
