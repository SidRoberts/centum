<?php

namespace Centum\Http;

use Centum\Interfaces\Http\ClientInterface;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;

class Client implements ClientInterface
{
    public function send(RequestInterface $request): ResponseInterface
    {
        //TODO
    }
}
