<?php

use Centum\Container\Container;
use Centum\Router\Router;

////////////////////////////////////////////////////////////////////////////////
//                                 CONTAINER                                  //
////////////////////////////////////////////////////////////////////////////////

$container = new Container();



////////////////////////////////////////////////////////////////////////////////
//                                APPLICATION                                 //
////////////////////////////////////////////////////////////////////////////////

$container->setDynamic(
    Router::class,
    function (Container $container): Router {
        return require __DIR__ . "/router.php";
    }
);

////////////////////////////////////////////////////////////////////////////////

// ...



////////////////////////////////////////////////////////////////////////////////
//                                  SERVICES                                  //
////////////////////////////////////////////////////////////////////////////////

// ...



////////////////////////////////////////////////////////////////////////////////
//                                 AND RETURN                                 //
////////////////////////////////////////////////////////////////////////////////

return $container;
