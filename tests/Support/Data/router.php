<?php

namespace Tests\Support\Controllers;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Router\Router;

/** @psalm-suppress UnnecessaryVarAnnotation */
/** @var ContainerInterface $container */

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
