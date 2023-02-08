<?php

namespace Centum\Interfaces\Http;

interface ClientInterface
{
    public function send(RequestInterface $request): ResponseInterface;
}
