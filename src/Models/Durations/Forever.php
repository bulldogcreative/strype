<?php

namespace Bulldog\Strype\Models\Durations;

use Bulldog\Strype\Contracts\Models\DurationInterface;

class Forever implements DurationInterface
{
    public function toArray(): array
    {
        return [
            'duration' => 'forever',
        ];
    }
}
