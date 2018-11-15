<?php

namespace Bulldog\Strype\Models\Durations;

use Bulldog\Strype\Contracts\Models\DurationsInterface;

class Once implements DurationInterface
{
    public function toArray(): array
    {
        return [
            'duration' => 'once',
        ];
    }
}
