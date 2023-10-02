<?php

namespace Centum\Http\Exception;

use Exception;

class CookieKeyEmptyException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            "Cookie must have a key."
        );
    }
}
