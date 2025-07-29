<?php

namespace Centum\Console\Terminal;

use Centum\Interfaces\Console\Terminal\ArgumentsInterface;
use InvalidArgumentException;

class Arguments implements ArgumentsInterface
{
    /**
     * @var non-empty-string
     */
    protected readonly string $filename;

    protected readonly string $commandName;

    /**
     * @var array<non-empty-string, string|bool>
     */
    protected readonly array $parameters;



    /**
     * @param array<string> $arguments
     *
     * @throws InvalidArgumentException
     */
    public function __construct(
        protected readonly array $arguments
    ) {
        $filename = array_shift($arguments);

        if ($filename === null || $filename === "") {
            throw new InvalidArgumentException(
                "Invalid filename."
            );
        }

        $this->filename = $filename;

        $this->commandName = array_shift($arguments) ?? "";

        $parameters = [];

        while ($arguments) {
            $token = array_shift($arguments);

            if (preg_match("/^\-\-([A-Za-z0-9\-]+)(\=(.*)|$)/", $token, $match) !== 1) {
                continue;
            }

            /** @var non-empty-string */
            $name = $match[1];

            $value = $match[3] ?? true;

            if ($match[2] === "" && isset($arguments[0]) && !str_starts_with($arguments[0], "--")) {
                $value = array_shift($arguments);
            }

            $parameters[$name] = $value;
        }

        $this->parameters = $parameters;
    }



    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getCommandName(): string
    {
        return $this->commandName;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }



    public function getParameter(string $name, mixed $defaultValue = null): mixed
    {
        return $this->parameters[$name] ?? $defaultValue;
    }

    public function hasParameter(string $name): bool
    {
        return array_key_exists($name, $this->parameters);
    }



    public function toArray(): array
    {
        return $this->arguments;
    }
}
