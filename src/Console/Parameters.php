<?php

namespace Centum\Console;

use Centum\Interfaces\Console\ParametersInterface;

class Parameters implements ParametersInterface
{
    /** @var array<string, mixed> */
    protected array $parameters = [];



    /**
     * @param list<string> $argv
     */
    public function __construct(array $argv)
    {
        // Remove script filename.
        array_shift($argv);

        // Remove command name.
        array_shift($argv);

        while ($argv) {
            $token = array_shift($argv);

            if (preg_match("/^\-\-([A-Za-z0-9\-]+)(\=(.*)|$)/", $token, $match) !== 1) {
                continue;
            }

            $name = $match[1];

            $value = $match[3] ?? true;

            if ($match[2] === "" && isset($argv[0]) && !str_starts_with($argv[0], "--")) {
                $value = array_shift($argv);
            }

            $this->parameters[$name] = $value;
        }
    }



    public function get(string $name, mixed $defaultValue = null): mixed
    {
        return $this->parameters[$name] ?? $defaultValue;
    }

    public function set(string $name, mixed $value): void
    {
        $this->parameters[$name] = $value;
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
