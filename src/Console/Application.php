<?php

namespace Centum\Console;

use Centum\Console\Command\ListCommand;
use Centum\Console\Command\QueueConsumeCommand;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\InvalidFilterException;
use Centum\Console\Exception\InvalidMiddlewareException;
use Centum\Console\Exception\ParamNotFoundException;
use Centum\Container\Container;
use Centum\Filter\FilterInterface;
use OutOfRangeException;
use Throwable;

class Application
{
    protected Container $container;

    /**
     * @var array<string, Command>
     */
    protected array $commands = [];

    /**
     * @var array<class-string, Command>
     */
    protected array $exceptionHandlers = [];



    public function __construct(Container $container)
    {
        $container->set(self::class, $this);

        $this->container = $container;

        $this->addCommand(new ListCommand());
        $this->addCommand(new QueueConsumeCommand());
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



    /**
     * @param class-string $exceptionClass
     */
    public function addExceptionHandler(string $exceptionClass, Command $command): void
    {
        $this->exceptionHandlers[$exceptionClass] = $command;
    }



    public function handle(Terminal $terminal): int
    {
        $argv = $terminal->getArgv();

        $command = $this->getCommandFromTerminal($terminal);

        $parameters = new Parameters($argv);



        try {
            $filters = $command->getFilters($this->container);

            /**
             * @var string $key
             */
            foreach ($filters as $key => $filter) {
                if (!($filter instanceof FilterInterface)) {
                    throw new InvalidFilterException();
                }

                if (!$parameters->has($key)) {
                    throw new ParamNotFoundException();
                }

                /**
                 * @var mixed
                 */
                $value = $parameters->get($key);

                /**
                 * @var mixed
                 */
                $value = $filter->filter($value);

                $parameters->set($key, $value);
            }



            return $command->execute($terminal, $this->container, $parameters);
        } catch (Throwable $exception) {
            foreach ($this->exceptionHandlers as $exceptionClass => $command) {
                if (is_a($exception, $exceptionClass)) {
                    return $command->execute($terminal, $this->container, $parameters);
                }
            }

            throw $exception;
        }
    }



    protected function getCommandFromTerminal(Terminal $terminal): Command
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
}
