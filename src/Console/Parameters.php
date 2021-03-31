<?php

namespace Centum\Console;

class Parameters
{
    /**
     * @var array<string, mixed>
     */
    protected array $parameters = [];



    public function __construct(array $argv)
    {
        $parameters = [];

        // Remove script filename.
        array_shift($argv);

        // Remove command name.
        array_shift($argv);

        while ($argv) {
            /**
             * @var string
             */
            $token = array_shift($argv);

            /**
             * @var string
             */
            $nextToken = $argv[0] ?? "";

            if (!preg_match("/^\-\-([A-Za-z0-9\-]+)(\=(.*)|$)/", $token, $match)) {
                continue;
            }

            /**
             * @var string
             */
            $name = $match[1];

            /**
             * @var string|boolean
             */
            $value = $match[3] ?? true;

            if ($match[2] === "" && !str_starts_with($nextToken, "--")) {
                /**
                 * @var string
                 */
                $value = array_shift($argv);
            }

            $parameters[$name] = $value;
        }

        $this->parameters = $parameters;
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
        return isset($this->parameters[$name]);
    }



    /**
     * @var array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->parameters;
    }
}
