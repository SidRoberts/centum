<?php

namespace Tests\Router\Controllers;

use Centum\Router\Router;

////////////////////////////////////////////////////////////////////////////////
//                                   ROUTER                                   //
////////////////////////////////////////////////////////////////////////////////

$router = new Router($container);



////////////////////////////////////////////////////////////////////////////////
//                                   ROUTES                                   //
////////////////////////////////////////////////////////////////////////////////

$group = $router->group();

$group->get("/", IndexController::class, "index");



////////////////////////////////////////////////////////////////////////////////
//                             EXCEPTION HANDLERS                             //
////////////////////////////////////////////////////////////////////////////////

// ...



////////////////////////////////////////////////////////////////////////////////
//                                 AND RETURN                                 //
////////////////////////////////////////////////////////////////////////////////

return $router;
