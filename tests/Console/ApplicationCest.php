<?php

namespace Tests\Console;

use Centum\Console\Application;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\InvalidCommandNameException;
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

        $application = new Application($container);

        $application->addCommand(MainCommand::class);

        $application->handle($terminal);

        $I->seeStdoutEquals(
            "main page"
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

    public function testGetCommand(ConsoleTester $I): void
    {
        $container = $I->grabContainer();

        $application = new Application($container);

        $application->addCommand(BoringCommand::class);
        $application->addCommand(MathCommand::class);

        $I->assertInstanceOf(
            BoringCommand::class,
            $application->getCommand("boring")
        );

        $I->assertInstanceOf(
            MathCommand::class,
            $application->getCommand("math:add")
        );

        $name = "doesnt-exist";

        $I->expectThrowable(
            new CommandNotFoundException($name),
            function () use ($application, $name): void {
                $application->getCommand($name);
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

    public function testExceptionHandlers(ConsoleTester $I): void
    {
        $container = $I->grabContainer();

        $application = new Application($container);

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

        $application = new Application($container);

        $I->expectThrowable(
            new InvalidCommandNameException("https://github.com/"),
            function () use ($application): void {
                $application->addCommand(BadNameCommand::class);
            }
        );
    }
}
