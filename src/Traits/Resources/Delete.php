<?php

namespace Bulldog\Strype\Traits\Resources;

trait DeleteResource
{
    /**
     * Permanently deletes a resource. It cannot be undone. Also immediately
     * cancels any active subscriptions on the resource.
     *
     * @param string $id The identifier of the resource to be retrieved
     */
    public function delete($id)
    {
        $this->stripe('retrieve', $id);
        $this->response->delete();
        $this->deleted = true;

        return $this;
    }
}
