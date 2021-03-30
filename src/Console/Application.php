<?php

namespace Centum\Console;

use Centum\Console\Command\ListCommand;
use Centum\Console\Command\ProcessTaskCommand;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\InvalidConverterException;
use Centum\Console\Exception\InvalidMiddlewareException;
use Centum\Console\Exception\ParamNotFoundException;
use Centum\Container\Container;
use OutOfRangeException;

class Application
{
    protected Container $container;

    /**
     * @var array<string, Command>
     */
    protected array $commands = [];



    public function __construct(Container $container)
    {
        $container->set(self::class, $this);

        $this->container = $container;

        $this->addCommand(new ListCommand());
        $this->addCommand(new ProcessTaskCommand());
    }



    public function addCommand(Command $command): void
    {
        $name = $command->getName();

        $this->commands[$name] = $command;
    }

    public function getCommand(string $name): Command
    {
        return $this->commands[$name] ?? throw new OutOfRangeException();
    }

    public function getCommands(): array
    {
        return $this->commands;
    }



    public function handle(Terminal $terminal): int
    {
        $argv = $terminal->getArgv();

        $command = $this->getCommandFromTerminal($terminal);

        $parameters = new Parameters($argv);



        $converters = $command->getConverters();

        foreach ($converters as $key => $converter) {
            if (!($converter instanceof ConverterInterface)) {
                throw new InvalidConverterException();
            }

            if (!$parameters->has($key)) {
                throw new ParamNotFoundException();
            }

            $value = $parameters->get($key);

            /**
             * @var mixed
             */
            $value = $converter->convert($value, $this->container);

            $parameters->set($key, $value);
        }



        return $command->execute($terminal, $this->container, $parameters);
    }



    protected function getCommandFromTerminal(Terminal $terminal): Command
    {
        /**
         * @var string
         */
        $name = $terminal->getArgv()[1] ?? "";

        /**
         * @var Command
         */
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
}
