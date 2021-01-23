<?php

namespace Centum\Mvc\Router;

use ReflectionMethod;
use Centum\Mvc\Controller;
use Centum\Mvc\Dispatcher\Path;
use Centum\Mvc\Router\Exception\ControllerNotFoundException;
use Centum\Mvc\Router\Exception\NotAControllerException;
use Centum\Mvc\Router\Exception\NotAnActionMethodException;
use Centum\Mvc\Router\Route\Converters;
use Centum\Mvc\Router\Route\Middlewares;
use Centum\Mvc\Router\Route\Requirements;
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
            $requirements = null;
            $middlewares = null;
            $converters = null;


            $attributes = $reflectionMethod->getAttributes();

            foreach ($attributes as $attribute) {
                $attribute = $attribute->newInstance();

                if (is_a($attribute, Uri::class)) {
                    $uri = $attribute;
                } elseif (is_a($attribute, Requirements::class)) {
                    $requirements = $attribute;
                } elseif (is_a($attribute, Middlewares::class)) {
                    $middlewares = $attribute;
                } elseif (is_a($attribute, Converters::class)) {
                    $converters = $attribute;
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
