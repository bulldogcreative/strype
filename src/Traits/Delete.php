<?php

namespace Bulldog\Strype\Traits;

trait Delete
{
    /**
     * Delete a customer.
     *
     * @param string $id
     *
     * @return $this
     */
    public function delete(string $id)
    {
        $this->stripe('retrieve', $id);
        $this->response->delete();
        $this->deleted = true;

        return $this;
    }
}
