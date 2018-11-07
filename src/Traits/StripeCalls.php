<?php

namespace Bulldog\Strype\Traits;

trait StripeCalls
{
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
}
