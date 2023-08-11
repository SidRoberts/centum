<?php

namespace Centum\Console\Exception;

class CommandParameterRequiredException extends \Exception
{
    public function __construct(
        protected readonly string $name
    ) {
        parent::__construct(
            sprintf(
                "'%s' is required.",
                $name
            )
        );
    }



    public function getName(): string
    {
        return $this->name;
    }
}
