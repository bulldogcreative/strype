<?php

namespace Bulldog\Strype\Models\Durations;

use Bulldog\Strype\Contracts\Models\DurationTypeInterface;

/**
 * Duration repeats every X months.
 */
class Repeating implements DurationTypeInterface
{
    protected $duration;
    protected $units;

    public function __construct(int $duration, string $units = 'duration_in_months')
    {
        $this->duration = $duration;
        $this->units = $units;
    }

    public function toArray(): array
    {
        return [
            'duration' => 'repeating',
            $this->units => $this->duration,
        ];
    }
}
