<?php

namespace Bulldog\Strype\Models;

use Bulldog\Strype\Contracts\Models\ProductTypeInterface;

/**
 * Base Product class.
 */
abstract class Product implements ProductTypeInterface
{
    protected $name;
    protected $type;
    protected $arguments;

    public function __construct(string $name, array $arguments = [])
    {
        $this->name = $name;
        $this->arguments = $arguments;
    }

    public function toArray(): array
    {
        $this->arguments['name'] = $this->name;
        $this->arguments['type'] = $this->type;

        return $this->arguments;
    }
}
