<?php

namespace Centum\Console\Exception;

use Centum\Interfaces\Console\ExceptionHandlerInterface;
use Exception;

class UnsuitableExceptionHandlerException extends Exception
{
    public function __construct(
        protected readonly ExceptionHandlerInterface $exceptionHandler
    ) {
        parent::__construct(
            $exceptionHandler::class
        );
    }



    public function getExceptionHandler(): ExceptionHandlerInterface
    {
        return $this->exceptionHandler;
    }
}
