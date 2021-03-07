<?php

namespace Centum\Console;

use Centum\Console\Command\ListCommand;
use Centum\Console\Command\ProcessTaskCommand;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\InvalidConverterException;
use Centum\Console\Exception\InvalidMiddlewareException;
use Centum\Console\Exception\ParamNotFoundException;
use Centum\Container\Container;

class Application
{
    protected Container $container;

    /**
     * @var Command[]
     */
    protected array $commands = [];



    public function __construct(Container $container)
    {
        $container->set(self::class, $this);

        $this->container = $container;

        $this->addCommand(new ListCommand());
        $this->addCommand(new ProcessTaskCommand());
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

            /**
             * @var string|boolean
             */
            $value = $params[$key] ?? throw new ParamNotFoundException();

            /**
             * @var mixed
             */
            $params[$key] = $converter->convert($value, $this->container);
        }



        return $command->execute($terminal, $this->container, $params);
    }



    protected function getCommandFromTerminal(Terminal $terminal) : Command
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



    /**
     * @return string[]|boolean[]
     */
    protected function getParamsFromArgv(array $argv) : array
    {
        $params = [];

        // Remove script filename.
        array_shift($argv);

        // Remove command name.
        array_shift($argv);

        while ($argv) {
            /**
             * @var string
             */
            $token = array_shift($argv);

            /**
             * @var string
             */
            $nextToken = $argv[0] ?? "";

            if (!preg_match("/^\-\-([A-Za-z0-9\-]+)(\=(.*)|$)/", $token, $match)) {
                continue;
            }

            $name = $match[1];
            $value = $match[3] ?? true;

            if ($match[2] === "" && !str_starts_with($nextToken, "--")) {
                /**
                 * @var string
                 */
                $value = array_shift($argv);
            }

            /**
             * @var string|boolean
             */
            $params[$name] = $value;
        }

        return $params;
    }
}
