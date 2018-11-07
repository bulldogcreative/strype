<?php

namespace Bulldog\Strype\Contracts;

interface UpdateResourceInterface
{
    /**
     * Updates the specified resource by setting the values of the parameters passed.
     *
     * @param string $id The identifier of the resource to be retrieved
     * @param array  $arguments  An array of additional arguments for Stripe
     */
    public function update($id, $arguments);
}
