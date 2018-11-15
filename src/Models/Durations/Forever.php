<?php

namespace Bulldog\Strype\Models\Durations;

use Bulldog\Strype\Contracts\Models\DurationsInterface;

class Forever implements DurationInterface
{
    public function toArray(): array
    {
        return [
            'duration' => 'forever',
        ];
    }
}
