<?php

namespace Centum\Http\Exception;

use OverflowException;

class FileGroupAlreadyExistsException extends OverflowException
{
    public function __construct(
        protected readonly string $id
    ) {
    }



    public function getID(): string
    {
        return $this->id;
    }
}
