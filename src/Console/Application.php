<?php

namespace Centum\Console;

use Centum\Console\Command\ListCommand;
use Centum\Console\Command\QueueConsumeCommand;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\InvalidCommandNameException;
use Centum\Console\Exception\InvalidFilterException;
use Centum\Console\Exception\ParamNotFoundException;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Filter\FilterInterface;
use Centum\Validator\CommandSlug;
use OutOfRangeException;
use Throwable;

class Application implements ApplicationInterface
{
    /** @var array<string, CommandInterface> */
    protected array $commands = [];

    /** @var array<class-string, CommandInterface> */
    protected array $exceptionHandlers = [];



    public function __construct(
        protected readonly ContainerInterface $container
    ) {
        $container->set(ApplicationInterface::class, $this);

        $this->addCommand(new ListCommand());
        $this->addCommand(new QueueConsumeCommand());
    }



    public function addCommand(CommandInterface $command): void
    {
        $name = $command->getName();

        if (!$this->validateName($name)) {
            throw new InvalidCommandNameException($command);
        }

        $this->commands[$name] = $command;
    }

    public function getCommand(string $name): CommandInterface
    {
        return $this->commands[$name] ?? throw new OutOfRangeException();
    }

    /**
     * @return array<string, CommandInterface>
     */
    public function getCommands(): array
    {
        return $this->commands;
    }



    /**
     * @param class-string $exceptionClass
     */
    public function addExceptionHandler(string $exceptionClass, CommandInterface $command): void
    {
        $this->exceptionHandlers[$exceptionClass] = $command;
    }



    public function handle(TerminalInterface $terminal): int
    {
        $argv = $terminal->getArgv();

        $command = $this->getCommandFromTerminal($terminal);

        $parameters = new Parameters($argv);



        try {
            $filters = $command->getFilters($this->container);

            foreach ($filters as $key => $filter) {
                if (!($filter instanceof FilterInterface)) {
                    throw new InvalidFilterException($filter);
                }

                if (!$parameters->has($key)) {
                    throw new ParamNotFoundException($key);
                }

                /** @var mixed */
                $value = $parameters->get($key);

                /** @var mixed */
                $value = $filter->filter($value);

                $parameters->set($key, $value);
            }



            return $command->execute($terminal, $this->container, $parameters);
        } catch (Throwable $exception) {
            foreach ($this->exceptionHandlers as $exceptionClass => $command) {
                /** @psalm-suppress DocblockTypeContradiction */
                if (is_a($exception, $exceptionClass)) {
                    $this->container->set(get_class($exception), $exception);
                    $this->container->set($exceptionClass, $exception);
                    $this->container->set(Throwable::class, $exception);

                    return $command->execute($terminal, $this->container, $parameters);
                }
            }

            throw $exception;
        }
    }



    protected function getCommandFromTerminal(TerminalInterface $terminal): CommandInterface
    {
        $name = $terminal->getArgv()[1] ?? "";

        $command = $this->commands[$name] ?? throw new CommandNotFoundException($name);



        $middleware = $command->getMiddleware();

        $success = $middleware->middleware($terminal, $command, $this->container);

        if (!$success) {
            throw new CommandNotFoundException($name);
        }



        return $command;
    }

    protected function validateName(string $name): bool
    {
        $validator = new CommandSlug();

        $messages = $validator->validate($name);

        return count($messages) === 0;
    }
}
