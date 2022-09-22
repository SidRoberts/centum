<?php

namespace Centum\Router;

class Parameters
{
    /** @var array<string, mixed> */
    protected readonly array $parameters;



    /**
     * @param array<string, mixed> $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }



    public function get(string $name, mixed $defaultValue = null): mixed
    {
        return $this->parameters[$name] ?? $defaultValue;
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->parameters);
    }



    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->parameters;
    }
}
