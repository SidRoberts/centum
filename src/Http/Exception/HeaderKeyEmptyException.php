<?php

namespace Centum\Http\Exception;

use Exception;

class HeaderKeyEmptyException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            "Header must have a key."
        );
    }
}
