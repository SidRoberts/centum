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
    /** @var array<string, class-string<CommandInterface>> */
    protected array $commands = [];

    /** @var array<class-string<ExceptionHandlerInterface>> */
    protected array $exceptionHandlers = [];



    public function __construct(
        protected readonly ContainerInterface $container,
    ) {
        $this->addCommand(ListCommand::class);
        $this->addCommand(QueueConsumeCommand::class);
    }



    /**
     * @param class-string<CommandInterface> $commandClass
     */
    public function getCommandMetadata(string $commandClass): CommandMetadata
    {
        $reflectionClass = new ReflectionClass($commandClass);

        $attributes = $reflectionClass->getAttributes(CommandMetadata::class);

        $attribute = $attributes[0] ?? throw new CommandMetadataNotFoundException($commandClass);

        return $attribute->newInstance();
    }



    /**
     * @param class-string<CommandInterface> $commandClass
     */
    public function addCommand(string $commandClass): void
    {
        $metadata = $this->getCommandMetadata($commandClass);

        $name = $metadata->getName();

        $this->commands[$name] = $commandClass;
    }

    /**
     * @return array<string, class-string<CommandInterface>>
     */
    public function getCommands(): array
    {
        return $this->commands;
    }



    /**
     * @param class-string<ExceptionHandlerInterface> $exceptionHandlerClass
     */
    public function addExceptionHandler(string $exceptionHandlerClass): void
    {
        $this->exceptionHandlers[] = $exceptionHandlerClass;
    }



    public function handle(TerminalInterface $terminal): int
    {
        $arguments = $terminal->getArguments();

        $resolverGroup = $this->container->getResolverGroup();

        $consoleResolver = new ConsoleResolver($arguments);

        $resolverGroup->add($consoleResolver);

        $name = $arguments->getCommandName();

        $commandClass = $this->commands[$name] ?? throw new CommandNotFoundException($name);

        $command = $this->container->get($commandClass);

        try {
            return $command->execute($terminal);
        } catch (Throwable $throwable) {
            return $this->handleException($terminal, $throwable);
        } finally {
            $resolverGroup->remove($consoleResolver);
        }
    }

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
