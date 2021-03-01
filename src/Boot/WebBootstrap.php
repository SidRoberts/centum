<?php

namespace Centum\Boot;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Mvc\Router;

class WebBootstrap extends Bootstrap
{
    public function boot(Container $container)
    {
        $router  = $container->typehintClass(Router::class);
        $request = $container->typehintClass(Request::class);

 

        $response = $router->handle($request);

        $response->send();
    }
}
