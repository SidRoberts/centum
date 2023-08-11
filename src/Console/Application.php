<?php

namespace Centum\Console;

use Centum\Console\Command\ListCommand;
use Centum\Console\Command\QueueConsumeCommand;
use Centum\Console\Exception\CommandMetadataNotFoundException;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\NotACommandException;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;
use ReflectionClass;
use Throwable;

class Application implements ApplicationInterface
{
    /** @var array<string, class-string> */
    protected array $commands = [];

    /** @var array<class-string, class-string> */
    protected array $exceptionHandlers = [];



    public function __construct(
        protected readonly ContainerInterface $container
    ) {
        $container->set(ApplicationInterface::class, $this);

        $this->addCommand(ListCommand::class);
        $this->addCommand(QueueConsumeCommand::class);
    }



    /**
     * @param class-string $commandClass
     */
    public function getCommandMetadata(string $commandClass): CommandMetadata
    {
        $reflectionClass = new ReflectionClass($commandClass);

        if (!$reflectionClass->isSubclassOf(CommandInterface::class)) {
            throw new NotACommandException($commandClass);
        }

        $attributes = $reflectionClass->getAttributes(CommandMetadata::class);

        $attribute = $attributes[0] ?? throw new CommandMetadataNotFoundException($commandClass);

        return $attribute->newInstance();
    }



    /**
     * @param class-string $commandClass
     */
    public function addCommand(string $commandClass): void
    {
        $metadata = $this->getCommandMetadata($commandClass);

        $name = $metadata->getName();

        $this->commands[$name] = $commandClass;
    }

    public function getCommand(string $name): CommandInterface
    {
        $commandClass = $this->commands[$name] ?? throw new CommandNotFoundException($name);

        $command = $this->resolveCommand($commandClass);

        return $command;
    }

    /**
     * @return array<string, class-string>
     */
    public function getCommands(): array
    {
        return $this->commands;
    }



    /**
     * @param class-string $exceptionClass
     * @param class-string $commandClass
     */
    public function addExceptionHandler(string $exceptionClass, string $commandClass): void
    {
        $reflectionClass = new ReflectionClass($commandClass);

        if (!$reflectionClass->isSubclassOf(CommandInterface::class)) {
            throw new NotACommandException($exceptionClass);
        }

        $this->exceptionHandlers[$exceptionClass] = $commandClass;
    }



    public function handle(TerminalInterface $terminal): int
    {
        $argv = $terminal->getArgv();

        $command = $this->getCommandFromTerminal($terminal);

        $parameters = new Parameters($argv);



        try {
            return $command->execute($terminal, $parameters);
        } catch (Throwable $exception) {
            foreach ($this->exceptionHandlers as $exceptionClass => $commandClass) {
                /** @psalm-suppress DocblockTypeContradiction */
                if (is_a($exception, $exceptionClass)) {
                    $this->container->set(get_class($exception), $exception);
                    $this->container->set($exceptionClass, $exception);
                    $this->container->set(Throwable::class, $exception);

                    $command = $this->resolveCommand($commandClass);

                    return $command->execute($terminal, $parameters);
                }
            }

            throw $exception;
        }
    }



    /**
     * @param class-string $commandClass
     */
    protected function resolveCommand(string $commandClass): CommandInterface
    {
        $command = $this->container->get($commandClass);

        if (!($command instanceof CommandInterface)) {
            throw new NotACommandException($commandClass);
        }

        return $command;
    }

    protected function getCommandFromTerminal(TerminalInterface $terminal): CommandInterface
    {
        $name = $terminal->getArgv()[1] ?? "";

        $command = $this->getCommand($name);

        $middleware = $command->getMiddleware();

        $success = $middleware->middleware($terminal, $command, $this->container);

        if (!$success) {
            throw new CommandNotFoundException($name);
        }

        return $command;
    }
}
