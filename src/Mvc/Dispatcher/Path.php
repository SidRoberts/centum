<?php

namespace Centum\Mvc\Dispatcher;

use Centum\Mvc\Dispatcher\Exception\ActionNotFoundException;
use Centum\Mvc\Dispatcher\Exception\ControllerNotFoundException;

class Path
{
    protected string $controller;

    protected string $action;



    public function __construct(string $controller, string $action)
    {
        // If the controller can't be loaded, we throw an exception.
        if (!class_exists($controller)) {
            throw new ControllerNotFoundException(
                sprintf(
                    "%s controller class does not exist.",
                    $controller
                )
            );
        }

        // Check if the method exists in the controller
        if (!method_exists($controller, $action)) {
            throw new ActionNotFoundException(
                sprintf(
                    "'%s::%s()' was not found.",
                    $controller,
                    $action
                )
            );
        }



        $this->controller = $controller;
        $this->action     = $action;
    }



    public function getController() : string
    {
        return $this->controller;
    }

    public function getAction() : string
    {
        return $this->action;
    }
}
