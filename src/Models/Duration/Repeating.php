<?php

namespace Bulldog\Strype\Models\Duration;

use Bulldog\Strype\Contracts\Models\DurationInterface;

class Repeating implements DurationInterface
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
