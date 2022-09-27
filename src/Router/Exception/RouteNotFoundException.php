<?php

namespace Centum\Router\Exception;

use Centum\Interfaces\Http\RequestInterface;

class RouteNotFoundException extends \Exception
{
    protected readonly RequestInterface $request;



    public function __construct(RequestInterface $request)
    {
        $message = sprintf(
            "%s %s",
            $request->getMethod(),
            $request->getUri()
        );

        parent::__construct($message);

        $this->request = $request;
    }



    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
