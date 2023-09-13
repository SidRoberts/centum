<?php

namespace Centum\App;

use Centum\Interfaces\App\BootstrapInterface;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Router\RouterInterface;

class WebBootstrap implements BootstrapInterface
{
    public function __construct(
        protected readonly RouterInterface $router,
        protected readonly RequestInterface $request
    ) {
    }

    public function boot(): void
    {
        $response = $this->router->handle($this->request);

        $response->send();
    }
}
