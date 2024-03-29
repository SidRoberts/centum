<?php

namespace Centum\Container\Exception;

class FileGroupNotFoundException extends \Exception
{
    public function __construct(
        protected readonly string $name
    ) {
        parent::__construct(
            sprintf(
                "Unable to find File Group with the ID of '%s'.",
                $name
            )
        );
    }



    public function getName(): string
    {
        return $this->name;
    }
}
