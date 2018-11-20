<?php

namespace Bulldog\Strype\Traits;

/**
 * Update.
 */
trait Update
{
    /**
     * Update a resource.
     *
     * @param string $id
     * @param array  $data
     *
     * @return self
     */
    public function update(string $id, array $data)
    {
        $this->stripe('retrieve', $id);

        foreach ($data as $key => $value) {
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
