<?php

namespace Centum\Router\Exception;

use Centum\Interfaces\Http\RequestInterface;

class RouteNotFoundException extends \Exception
{
    public function __construct(
        protected readonly RequestInterface $request
    ) {
        $message = sprintf(
            "%s %s",
            $request->getMethod(),
            $request->getUri()
        );

        parent::__construct($message);
    }



    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
