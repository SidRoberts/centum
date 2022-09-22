<?php

namespace Centum\Router\Exception;

use Centum\Http\Request;

class RouteNotFoundException extends \Exception
{
    protected readonly Request $request;



    public function __construct(Request $request)
    {
        $message = sprintf(
            "%s %s",
            $request->getMethod(),
            $request->getUri()
        );

        parent::__construct($message);

        $this->request = $request;
    }



    public function getRequest(): Request
    {
        return $this->request;
    }
}
