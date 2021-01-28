<?php

namespace Centum\Mvc\Exception;

use Centum\Http\Request;

class RouteNotFoundException extends \Exception
{
    public function __construct(Request $request)
    {
        //TODO
    }
}
