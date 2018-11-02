<?php

namespace Bulldog\Strype;

use Bulldog\Strype\Contracts\ResourceInterface;

abstract class Resource implements ResourceInterface
{
    /**
     * Returns the unique identifier for the object. Needed for ResourceInterface.
     *
     * @return string
     */
    public function getResourceId(): string
    {
        return $this->id;
    }

    /**
     * Returns true if the object exists in live mode or false if the object
     * exists in test mode. Needed for ResourceInterface.
     *
     * @return bool
     */
    public function wasLiveMode(): bool
    {
        return $this->livemode;
    }

    /**
     * Call a Stripe static method.
     *
     * @see https://stripe.com/docs/api
     *
     * @param string $method
     * @param array  $arguments
     */
    protected function stripe($method, $arguments)
    {
        // The name of the class calling this method will match the name of the
        // class that Stripe uses as well. This allows us to easily call the
        // Stripe static methods.
        $this->{$this->getClassName()}($method, $arguments);
        $this->setProperties();

        return $this->response;
    }

    /**
     * Call methods on the the Stripe Customer class.
     *
     * @param string $method
     * @param array  $arguments
     */
    protected function customer($method, $arguments)
    {
        $this->response = \Stripe\Customer::{$method}($arguments);
    }

    /**
     * Call methods on the the Stripe Charge class.
     *
     * @param string $method
     * @param array  $arguments
     */
    protected function charge($method, $arguments)
    {
        $this->response = \Stripe\Charge::{$method}($arguments);
    }

    protected function setProperties()
    {
        // Loop through the response object
        foreach ($this->response->keys() as $key) {
            // Set those properties on this object
            $this->{$key} = $this->response->{$key};
        }
    }

    /**
     * Get a simple class name in all lowercase.
     */
    protected function getClassName()
    {
        $data = get_class($this);
        $data = explode('\\', $data);
        $data = end($data);
        $data = strtolower($data);

        return $data;
    }
}
