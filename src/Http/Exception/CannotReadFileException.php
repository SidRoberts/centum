<?php

namespace Centum\Http\Exception;

use Exception;

class CannotReadFileException extends Exception
{
    public function __construct(
        protected readonly string $path
    ) {
        parent::__construct(
            "Unable to read file."
        );
    }



    public function getPath(): string
    {
        return $this->path;
    }
}
