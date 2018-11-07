<?php

namespace Bulldog\Strype;

/**
 * Class Resource.
 */
abstract class Resource
{
    protected $id;

    protected $response;

    public function getId()
    {
        return $this->id;
    }

    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set the response data as properties on the class.
     */
    protected function setProperties()
    {
        // Loop through the response object
        foreach ($this->response->keys() as $key) {
            // Set those properties on this object
            $this->{$key} = $this->response->{$key};
        }
    }
}
