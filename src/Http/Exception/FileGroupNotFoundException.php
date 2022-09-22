<?php

namespace Centum\Http\Exception;

use OutOfBoundsException;

class FileGroupNotFoundException extends OutOfBoundsException
{
    protected string $id;



    public function __construct(string $id)
    {
        $this->id = $id;
    }



    public function getID(): string
    {
        return $this->id;
    }
}
