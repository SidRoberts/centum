<?php

namespace Centum\Console\Exception;

class CommandMetadataNotFoundException extends \Exception
{
    /**
     * @param class-string $class
     */
    public function __construct(
        protected readonly string $class
    ) {
    }



    public function getClass(): string
    {
        return $this->class;
    }
}
