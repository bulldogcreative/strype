<?php

namespace Bulldog\Strype\Models\Durations;

use Bulldog\Strype\Contracts\Models\DurationInterface;

class Once implements DurationInterface
{
    public function toArray(): array
    {
        return [
            'duration' => 'once',
        ];
    }
}
