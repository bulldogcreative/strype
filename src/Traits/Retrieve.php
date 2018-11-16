<?php



namespace Bulldog\Strype\Traits;

trait Retrieve
{
    /**
     * Get a customer by their ID.
     *
     * @param string $id
     *
     * @return $this
     */
    public function retrieve(string $id)
    {
        $this->stripe('retrieve', $id);

        return $this;
    }
}
