<?php

namespace Bulldog\Strype\Models\Durations;

use Bulldog\Strype\Contracts\Models\DurationTypeInterface;

class Forever implements DurationTypeInterface
{
    public function toArray(): array
    {
        return [
            'duration' => 'forever',
        ];
    }
}
