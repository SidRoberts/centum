<?php

namespace Centum\Interfaces\Console\Terminal;

interface ArgumentsInterface
{
    public function getFilename(): string;

    public function getCommandName(): string;

    public function getParameters(): array;



    public function getParameter(string $name, mixed $defaultValue = null): mixed;

    public function hasParameter(string $name): bool;



    /**
     * @return array<string>
     */
    public function toArray(): array;
}
