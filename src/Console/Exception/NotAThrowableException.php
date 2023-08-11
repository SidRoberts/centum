<?php

namespace Centum\Console\Exception;

class NotAThrowableException extends \Exception
{
    /**
     * @param class-string $class
     */
    public function __construct(
        protected readonly string $class
    ) {
    }



    /**
     * @return class-string
     */
    public function getClass(): string
    {
        return $this->class;
    }
}
