<?php

namespace Bulldog\Strype\Contracts;

interface DeleteResourceInterface
{
    /**
     * Permanently deletes a resource. It cannot be undone. Also immediately
     * cancels any active subscriptions on the resource.
     *
     * @param string $id The identifier of the resource to be retrieved
     */
    public function delete($id);
}
