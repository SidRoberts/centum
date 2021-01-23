<?php

namespace Centum\Mvc;

use Centum\Container\Resolver;
use Centum\Mvc\Dispatcher\Path;

/**
 * Takes a Dispatcher\Path object, instantiates the controller and calls the
 * action method. It uses a Resolver to typehint the controller constructor and
 * inject all sorts of lovely goodness.
 */
class Dispatcher
{
    protected Resolver $resolver;



    public function __construct(Resolver $resolver)
    {
        $this->resolver = $resolver;
    }



    public function dispatch(Path $path, Parameters $parameters)
    {
        $controllerName = $path->getController();
        $action         = $path->getAction();



        $controller = new $controllerName;

        $returnedValue = $this->resolver->typehintMethod(
            $controller,
            $action,
            [
                "parameters" => $parameters,
            ]
        );

        return $returnedValue;
    }
}
