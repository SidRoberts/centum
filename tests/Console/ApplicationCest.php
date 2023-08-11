<?php

namespace Tests\Console;

use Centum\Console\Application;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\InvalidCommandNameException;
use Centum\Console\Exception\NotACommandException;
use Centum\Console\Exception\NotAThrowableException;
use Centum\Interfaces\Console\CommandBuilderInterface;
use Exception;
use Tests\Support\Commands\BadNameCommand;
use Tests\Support\Commands\BoringCommand;
use Tests\Support\Commands\ErrorCommand;
use Tests\Support\Commands\MainCommand;
use Tests\Support\Commands\MathCommand;
use Tests\Support\Commands\ProblematicCommand;
use Tests\Support\ConsoleTester;
use Throwable;

class ApplicationCest
{
    public function testBasicHandle(ConsoleTester $I): void
    {
        $argv = [
            "cli.php",
            "",
        ];

        $terminal = $I->createTerminal($argv);

        $container = $I->grabContainer();

        $commandBuilder = $I->grabFromContainer(CommandBuilderInterface::class);

        $application = new Application($container, $commandBuilder);

        $application->addCommand(MainCommand::class);

        $application->handle($terminal);

        $I->seeStdoutEquals(
            "main page"
        );
    }

    public function testParametersAreInjectedIntoCommand(ConsoleTester $I): void
    {
        $argv = [
            "cli.php",
            "math:add",
            "--a",
            "123",
            "--b",
            "456",
        ];

        $terminal = $I->createTerminal($argv);

        $container = $I->grabContainer();

        $commandBuilder = $I->grabFromContainer(CommandBuilderInterface::class);

        $application = new Application($container, $commandBuilder);

        $application->addCommand(MathCommand::class);

        $application->handle($terminal);

        $I->seeStdoutEquals(
            "123+456=579"
        );
    }



    public function testCommandNotSpecified(ConsoleTester $I): void
    {
        $argv = [
            "cli.php",
        ];

        $terminal = $I->createTerminal($argv);

        $container = $I->grabContainer();

        $commandBuilder = $I->grabFromContainer(CommandBuilderInterface::class);

        $application = new Application($container, $commandBuilder);

        $application->addCommand(MainCommand::class);

        $application->handle($terminal);

        $I->seeStdoutEquals(
            "main page"
        );
    }

    public function testCommandNotFoundException(ConsoleTester $I): void
    {
        $name = "this:command:does:not:exist";

        $argv = [
            "cli.php",
            $name,
        ];

        $terminal = $I->createTerminal($argv);

        $container = $I->grabContainer();

        $commandBuilder = $I->grabFromContainer(CommandBuilderInterface::class);

        $application = new Application($container, $commandBuilder);

        $I->expectThrowable(
            new CommandNotFoundException($name),
            function () use ($application, $terminal): void {
                $application->handle($terminal);
            }
        );
    }

    public function testGetCommands(ConsoleTester $I): void
    {
        $container = $I->grabContainer();

        $commandBuilder = $I->grabFromContainer(CommandBuilderInterface::class);

        $application = new Application($container, $commandBuilder);

        $application->addCommand(BoringCommand::class);
        $application->addCommand(MathCommand::class);

        $commands = $application->getCommands();

        $I->assertArrayHasKey(
            "boring",
            $commands
        );

        $I->assertArrayHasKey(
            "math:add",
            $commands
        );
    }

    public function testException(ConsoleTester $I): void
    {
        $container = $I->grabContainer();

        $commandBuilder = $I->grabFromContainer(CommandBuilderInterface::class);

        $application = new Application($container, $commandBuilder);

        $application->addCommand(ProblematicCommand::class);



        $argv = [
            "cli.php",
            "problematic",
        ];

        $terminal = $I->createTerminal($argv);

        $I->expectThrowable(
            new Exception("I'm being difficult."),
            function () use ($application, $terminal): void {
                $application->handle($terminal);
            }
        );
    }

    public function testAddExceptionHandlerNotAThrowable(ConsoleTester $I): void
    {
        $container = $I->grabContainer();

        $commandBuilder = $I->grabFromContainer(CommandBuilderInterface::class);

        $application = new Application($container, $commandBuilder);

        $notAThrowableClass = ErrorCommand::class;

        $I->expectThrowable(
            new NotAThrowableException($notAThrowableClass),
            function () use ($application, $notAThrowableClass): void {
                $application->addExceptionHandler(
                    $notAThrowableClass,
                    ErrorCommand::class
                );
            }
        );
    }

    public function testAddExceptionHandlerNotACommand(ConsoleTester $I): void
    {
        $container = $I->grabContainer();

        $commandBuilder = $I->grabFromContainer(CommandBuilderInterface::class);

        $application = new Application($container, $commandBuilder);

        $notACommandClass = Exception::class;

        $I->expectThrowable(
            new NotACommandException($notACommandClass),
            function () use ($application, $notACommandClass): void {
                $application->addExceptionHandler(
                    Throwable::class,
                    $notACommandClass
                );
            }
        );
    }

    public function testExceptionHandlers(ConsoleTester $I): void
    {
        $container = $I->grabContainer();

        $commandBuilder = $I->grabFromContainer(CommandBuilderInterface::class);

        $application = new Application($container, $commandBuilder);

        $application->addCommand(ProblematicCommand::class);

        $application->addExceptionHandler(
            Throwable::class,
            ErrorCommand::class
        );



        $argv = [
            "cli.php",
            "problematic",
        ];

        $terminal = $I->createTerminal($argv);

        $exitCode = $application->handle($terminal);



        $I->seeStderrEquals(
            "Something went wrong. Exception was thrown with the message \"I'm being difficult.\"."
        );

        $I->assertEquals(
            1,
            $exitCode
        );
    }

    public function testValidCommandName(ConsoleTester $I): void
    {
        $container = $I->grabContainer();

        $commandBuilder = $I->grabFromContainer(CommandBuilderInterface::class);

        $application = new Application($container, $commandBuilder);

        $I->expectThrowable(
            new InvalidCommandNameException("https://github.com/"),
            function () use ($application): void {
                $application->addCommand(BadNameCommand::class);
            }
        );
    }
}
