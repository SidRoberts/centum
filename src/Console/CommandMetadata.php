<?php

namespace Centum\Console;

use Attribute;
use Centum\Console\Exception\InvalidCommandNameException;

#[Attribute(Attribute::TARGET_CLASS)]
class CommandMetadata
{
    /**
     * @throws InvalidCommandNameException
     */
    public function __construct(
        protected readonly string $name,
        protected readonly string $description = ""
    ) {
        if ($name !== "" && preg_match("/^([a-z0-9]+(?:-[a-z0-9]+)*)(?:\:[a-z0-9]+(?:-[a-z0-9]+)*)*$/", $name) !== 1) {
            throw new InvalidCommandNameException($name);
        }
    }



    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
