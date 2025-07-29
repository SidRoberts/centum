<?php

namespace Tests\Support\Container\Services;

use Centum\Http\RequestFactory;
use Centum\Interfaces\Container\ServiceInterface;
use Centum\Interfaces\Http\RequestInterface;

/**
 * @implements ServiceInterface<RequestInterface>
 */
final class RequestService implements ServiceInterface
{
    public function __construct(
        protected readonly RequestFactory $requestFactory
    ) {
    }

    public function build(): RequestInterface
    {
        return $this->requestFactory->createFromGlobals();
    }
}
