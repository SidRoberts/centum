<?php

namespace Centum\Interfaces\Console\Terminal;

interface ArgumentsInterface
{
    public function getFilename(): string;

    public function getCommandName(): string;

    /**
     * @return array<non-empty-string, string|bool>
     */
    public function getParameters(): array;



    /**
     * @param non-empty-string $name
     */
    public function getParameter(string $name, mixed $defaultValue = null): mixed;

    /**
     * @param non-empty-string $name
     */
    public function hasParameter(string $name): bool;



    /**
     * @return array<string>
     */
    public function toArray(): array;
}
