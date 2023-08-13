<?php

namespace Centum\Container\Exception;

class FileGroupNotFoundException extends \Exception
{
    public function __construct(
        protected readonly string $name
    ) {
    }



    public function getName(): string
    {
        return $this->name;
    }
}
