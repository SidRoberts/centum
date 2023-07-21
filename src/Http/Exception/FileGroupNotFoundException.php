<?php

namespace Centum\Http\Exception;

use OutOfBoundsException;

class FileGroupNotFoundException extends OutOfBoundsException
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
