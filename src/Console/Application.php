<?php

namespace Centum\Console;

use Centum\Console\Command\ListCommand;
use Centum\Console\Command\QueueConsumeCommand;
use Centum\Console\Exception\CommandMetadataNotFoundException;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\NotACommandException;
use Centum\Console\Exception\NotAThrowableException;
use Centum\Container\ConsoleResolver;
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
        protected readonly ContainerInterface $container,
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
        if ($exceptionClass !== Throwable::class && !is_subclass_of($exceptionClass, Throwable::class)) {
            throw new NotAThrowableException($exceptionClass);
        }

        if (!is_subclass_of($commandClass, CommandInterface::class)) {
            throw new NotACommandException($commandClass);
        }

        $this->exceptionHandlers[$exceptionClass] = $commandClass;
    }



    public function handle(TerminalInterface $terminal): int
    {
        $arguments = $terminal->getArguments();

        $this->container->addResolver(
            new ConsoleResolver($arguments)
        );

        $name = $arguments->getCommandName();

        $commandClass = $this->commands[$name] ?? throw new CommandNotFoundException($name);

        /** @var CommandInterface */
        $command = $this->container->get($commandClass);

        try {
            return $command->execute($terminal);
        } catch (Throwable $exception) {
            foreach ($this->exceptionHandlers as $exceptionClass => $commandClass) {
                /** @psalm-suppress DocblockTypeContradiction */
                if (is_a($exception, $exceptionClass)) {
                    $this->container->set(get_class($exception), $exception);
                    $this->container->set($exceptionClass, $exception);
                    $this->container->set(Throwable::class, $exception);

                    /** @var CommandInterface */
                    $command = $this->container->get($commandClass);

                    return $command->execute($terminal);
                }
            }

            throw $exception;
        }
    }
}
