<?php

namespace Tests\Console;

use Centum\Console\Application;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\InvalidCommandNameException;
use Centum\Console\Exception\NotAnExceptionHandlerException;
use Exception;
use Tests\Support\Commands\BadNameCommand;
use Tests\Support\Commands\BoringCommand;
use Tests\Support\Commands\HelloCommand;
use Tests\Support\Commands\MainCommand;
use Tests\Support\Commands\MathCommand;
use Tests\Support\Commands\ProblematicCommand;
use Tests\Support\Commands\ThrowableExceptionHandler;
use Tests\Support\ConsoleTester;

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

        $application = new Application($container);

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

        $application = new Application($container);

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

        $application = new Application($container);

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

        $application = new Application($container);

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

        $application = new Application($container);

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

        $application = new Application($container);

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



    public function testAddExceptionHandlerNotAnExceptionHandler(ConsoleTester $I): void
    {
        $container = $I->grabContainer();

        $application = new Application($container);

        $notAnExceptionHandlerClass = Exception::class;

        $I->expectThrowable(
            new NotAnExceptionHandlerException($notAnExceptionHandlerClass),
            function () use ($application, $notAnExceptionHandlerClass): void {
                $application->addExceptionHandler(
                    $notAnExceptionHandlerClass
                );
            }
        );
    }

    public function testExceptionHandlers(ConsoleTester $I): void
    {
        $container = $I->grabContainer();

        $application = new Application($container);

        $application->addCommand(ProblematicCommand::class);

        $application->addExceptionHandler(
            ThrowableExceptionHandler::class
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

        $application = new Application($container);

        $I->expectThrowable(
            new InvalidCommandNameException("https://github.com/"),
            function () use ($application): void {
                $application->addCommand(BadNameCommand::class);
            }
        );
    }

    public function testStringAndBoolTypes(ConsoleTester $I): void
    {
        $container = $I->grabContainer();

        $application = new Application($container);

        $application->addCommand(HelloCommand::class);

        $argv = [
            "cli.php",
            "hello",
            "--name",
            "Sid",
            "--loud",
        ];

        $terminal = $I->createTerminal($argv);

        $application->handle($terminal);

        $I->seeStdoutEquals(
            "HELLO SID!" . PHP_EOL
        );
    }
}
