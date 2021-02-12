<?php

namespace Centum\Console;

use Centum\Container\Container;

abstract class Command
{
    abstract public function getName() : string;

    public function getDescription() : string
    {
        return "";
    }

    public function getHelp() : string
    {
        return "";
    }



    public function getMiddlewares() : array
    {
        return [];
    }

    public function getConverters() : array
    {
        return [];
    }



    abstract public function execute(Terminal $terminal, Container $container, array $params) : int;
}
