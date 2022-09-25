<?php

namespace Centum\App;

use Centum\Http\Request;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Router\Router;

class WebBootstrap extends Bootstrap
{
    public function boot(ContainerInterface $container): void
    {
        $router = $container->typehintClass(Router::class);

        $request = $container->typehintClass(Request::class);



        $response = $router->handle($request);

        $response->send();
    }
}
