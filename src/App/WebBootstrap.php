<?php

namespace Centum\App;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Router\RouterInterface;

class WebBootstrap extends Bootstrap
{
    public function boot(ContainerInterface $container): void
    {
        $router = $container->get(RouterInterface::class);

        $request = $container->get(RequestInterface::class);



        $response = $router->handle($request);

        $response->send();
    }
}
