<?php

declare(strict_types=1);

namespace Bulldog\Strype\Traits;

trait ListAll
{
    public function listAll(array $arguments = [])
    {
        $this->stripe('all', $arguments);

        return $this;
    }
}
