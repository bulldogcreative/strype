<?php



namespace Bulldog\Strype\Traits;

trait ListAll
{
    public function listAll(array $arguments = [])
    {
        $this->stripe('all', $arguments);

        return $this;
    }
}
