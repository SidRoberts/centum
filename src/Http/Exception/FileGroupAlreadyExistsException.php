<?php

namespace Centum\Http\Exception;

use OverflowException;

class FileGroupAlreadyExistsException extends OverflowException
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