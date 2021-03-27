<?php

namespace Centum\Mvc\Exception;

use Centum\Http\Request;

class RouteNotFoundException extends \Exception
{
    public function __construct(Request $request)
    {
        $message = sprintf(
            "%s %s",
            $request->getMethod(),
            $request->getUri()
        );

        parent::__construct($message);
    }
}
