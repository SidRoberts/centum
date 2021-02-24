<?php

namespace Centum\Console;

use Centum\Console\Command\ListCommand;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\InvalidConverterException;
use Centum\Console\Exception\InvalidMiddlewareException;
use Centum\Console\Exception\ParamNotFoundException;
use Centum\Container\Container;

class Application
{
    protected Container $container;

    protected array $commands = [];



    public function __construct(Container $container)
    {
        $container->set(self::class, $this);

        $this->container = $container;

        $this->addCommand(new ListCommand());
    }



    public function addCommand(Command $command) : void
    {
        $name = $command->getName();

        $this->commands[$name] = $command;
    }

    public function getCommands() : array
    {
        return $this->commands;
    }



    public function handle(Terminal $terminal) : int
    {
        $argv = $terminal->getArgv();

        $command = $this->getCommandFromTerminal($terminal);

        $params = $this->getParamsFromArgv($argv);



        $converters = $command->getConverters();

        foreach ($converters as $key => $converter) {
            if (!($converter instanceof ConverterInterface)) {
                throw new InvalidConverterException();
            }

            $value = $params[$key] ?? throw new ParamNotFoundException();

            $params[$key] = $converter->convert($value, $this->container);
        }



        return $command->execute($terminal, $this->container, $params);
    }



    protected function getCommandFromTerminal(Terminal $terminal) : Command
    {
        $name = $terminal->getArgv()[1] ?? "";

        $command = $this->commands[$name] ?? throw new CommandNotFoundException();



        $middlewares = $command->getMiddlewares();

        foreach ($middlewares as $middleware) {
            if (!($middleware instanceof MiddlewareInterface)) {
                throw new InvalidMiddlewareException();
            }

            $success = $middleware->middleware($terminal, $command, $this->container);

            if (!$success) {
                throw new CommandNotFoundException();
            }
        }



        return $command;
    }



    protected function getParamsFromArgv(array $argv) : array
    {
        $params = [];

        // Remove script filename.
        array_shift($argv);

        // Remove command name.
        array_shift($argv);

        while ($argv) {
            $token = array_shift($argv);
            $nextToken = $argv[0] ?? "";

            if (!preg_match("/^\-\-([A-Za-z0-9\-]+)(\=(.*)|$)/", $token, $match)) {
                continue;
            }

            $name = $match[1];
            $value = $match[3] ?? true;

            if ($match[2] === "" && !str_starts_with($nextToken, "--")) {
                $value = array_shift($argv);
            }

            $params[$name] = $value;
        }

        return $params;
    }
}
