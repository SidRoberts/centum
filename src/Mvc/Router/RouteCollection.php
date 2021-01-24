<?php

namespace Centum\Mvc\Router;

use ReflectionMethod;
use Centum\Mvc\Controller;
use Centum\Mvc\Dispatcher\Path;
use Centum\Mvc\Router\Exception\ControllerNotFoundException;
use Centum\Mvc\Router\Exception\NotAControllerException;
use Centum\Mvc\Router\Exception\NotAnActionMethodException;
use Centum\Mvc\Router\Route\Converter;
use Centum\Mvc\Router\Route\Middleware;
use Centum\Mvc\Router\Route\Requirement;
use Centum\Mvc\Router\Route\Uri;

class RouteCollection
{
    protected array $routes = [];



    public function getRoutes() : array
    {
        return $this->routes;
    }



    public function addController(string $controller)
    {
        if (!class_exists($controller)) {
            throw new ControllerNotFoundException(
                $controller
            );
        }

        if (!is_subclass_of($controller, Controller::class)) {
            throw new NotAControllerException(
                $controller
            );
        }



        // Get public methods.
        $actions = get_class_methods($controller);

        foreach ($actions as $action) {
            $reflectionMethod = new ReflectionMethod(
                $controller,
                $action
            );


            $uri = null;
            $requirements = [];
            $middlewares = [];
            $converters = [];


            $attributes = $reflectionMethod->getAttributes();

            foreach ($attributes as $attribute) {
                $attribute = $attribute->newInstance();

                if (is_a($attribute, Uri::class)) {
                    $uri = $attribute;
                } elseif (is_a($attribute, Requirement::class)) {
                    $requirements[] = $attribute;
                } elseif (is_a($attribute, Middleware::class)) {
                    $middlewares[] = $attribute;
                } elseif (is_a($attribute, Converter::class)) {
                    $converters[] = $attribute;
                }
            }

            // If there's no URI then the method is not an action.
            if (!$uri) {
                throw new NotAnActionMethodException(
                    $controller . "::" . $action
                );
            }

            $path = new Path(
                $controller,
                $action
            );

            $route = new Route(
                $uri,
                $path,
                $requirements,
                $middlewares,
                $converters
            );

            $this->routes[] = $route;
        }
    }

    public function addControllers(array $controllers)
    {
        foreach ($controllers as $controller) {
            $this->addController($controller);
        }
    }
}
