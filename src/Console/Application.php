<?php

namespace Centum\Console;

use Centum\Console\Command\ListCommand;
use Centum\Console\Command\QueueConsumeCommand;
use Centum\Console\Exception\CommandMetadataNotFoundException;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\UnsuitableExceptionHandlerException;
use Centum\Container\Resolver\ConsoleResolver;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\ExceptionHandlerInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;
use ReflectionClass;
use Throwable;

class Application implements ApplicationInterface
{
    /**
     * @var array<string, class-string<CommandInterface>>
     */
    protected array $commands = [];

    /**
     * @var list<class-string<ExceptionHandlerInterface>>
     */
    protected array $exceptionHandlers = [];



    /**
     * @throws CommandMetadataNotFoundException
     */
    public function __construct(
        protected readonly ContainerInterface $container,
    ) {
        $this->addCommand(ListCommand::class);
        $this->addCommand(QueueConsumeCommand::class);
    }



    /**
     * @param class-string<CommandInterface> $commandClass
     *
     * @throws CommandMetadataNotFoundException
     */
    public function getCommandMetadata(string $commandClass): CommandMetadata
    {
        $reflectionClass = new ReflectionClass($commandClass);

        $attributes = $reflectionClass->getAttributes(CommandMetadata::class);

        if (count($attributes) === 0) {
            throw new CommandMetadataNotFoundException($commandClass);
        }

        $attribute = $attributes[0];

        return $attribute->newInstance();
    }



    /**
     * @throws CommandMetadataNotFoundException
     */
    public function addCommand(string $commandClass): void
    {
        $metadata = $this->getCommandMetadata($commandClass);

        $name = $metadata->getName();

        $this->commands[$name] = $commandClass;
    }

    public function getCommands(): array
    {
        return $this->commands;
    }



    public function addExceptionHandler(string $exceptionHandlerClass): void
    {
        $this->exceptionHandlers[] = $exceptionHandlerClass;
    }



    /**
     * @throws Throwable
     * @throws CommandNotFoundException
     */
    public function handle(TerminalInterface $terminal): int
    {
        $arguments = $terminal->getArguments();

        $resolverGroup = $this->container->getResolverGroup();

        $consoleResolver = new ConsoleResolver($arguments);

        $resolverGroup->add($consoleResolver);

        $name = $arguments->getCommandName();

        if (!isset($this->commands[$name])) {
            throw new CommandNotFoundException($name);
        }

        $commandClass = $this->commands[$name];

        $command = $this->container->get($commandClass);

        try {
            return $command->execute($terminal);
        } catch (Throwable $throwable) {
            return $this->handleException($terminal, $throwable);
        } finally {
            $resolverGroup->remove($consoleResolver);
        }
    }

    /**
     * @throws Throwable
     */
    protected function handleException(TerminalInterface $terminal, Throwable $throwable): int
    {
        foreach ($this->exceptionHandlers as $exceptionHandlerClass) {
            $exceptionHandler = $this->container->get($exceptionHandlerClass);

            try {
                $exceptionHandler->handle($terminal, $throwable);
            } catch (UnsuitableExceptionHandlerException) {
                continue;
            }

            return CommandInterface::FAILURE;
        }

        throw $throwable;
    }
}
