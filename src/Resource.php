<?php

namespace Bulldog\Strype;

/**
 * Class Resource.
 */
abstract class Resource
{
    /**
     * A unique identifier for the resource.
     *
     * @var string
     */
    public $id;

    /**
     * A response from Stripe.
     *
     * @var mixed
     */
    protected $response;

    /**
     * Returns the unique identifier for that resource.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Returns the raw Stripe response.
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set the response data as properties on the class.
     */
    protected function setProperties(): void
    {
        // Loop through the response object
        foreach ($this->response->keys() as $key) {
            // Set those properties on this object
            $this->{$key} = $this->response->{$key};
        }
    }
}
