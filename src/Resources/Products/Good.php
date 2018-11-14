<?php

namespace Bulldog\Strype\Resources\Products;

use Bulldog\Strype\Contracts\Resources\ProductTypeInterface;

class Good implements ProductTypeInterface
{
    protected $name;
    protected $arguments;

    public function __construct(string $name, array $arguments = [])
    {
        $this->name = $name;
        $this->arguments = $arguments;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return 'good';
    }

    public function getArguments(): array
    {
        $this->arguments['name'] = $this->name;
        $this->arguments['type'] = $this->getType();

        return $this->arguments;
    }
}
