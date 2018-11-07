<?php

namespace Bulldog\Strype\Traits\Resources;

trait UpdateResource
{
    /**
     * Updates the specified resource by setting the values of the parameters passed.
     *
     * @param string $id The identifier of the resource to be retrieved
     * @param array  $arguments  An array of additional arguments for Stripe
     */
    public function update($id, $arguments)
    {
        $this->stripe('retrieve', $id);

        foreach ($arguments as $key => $value) {
            // Update the local property
            $this->{$key} = $value;
            // Update the response object
            $this->response->{$key} = $value;
        }

        // Call save method on the response to save the changes to Stripe
        $this->response->save();

        return $this;
    }
}
