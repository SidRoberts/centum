<?php

namespace Tests\Console;

use Centum\Console\Application;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\InvalidCommandNameException;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\Commands\BadNameCommand;
use Tests\Support\Commands\ErrorCommand;
use Tests\Support\Commands\MainCommand;
use Tests\Support\Commands\MathCommand;
use Tests\Support\Commands\Middleware\FalseCommand;
use Tests\Support\Commands\Middleware\TrueCommand;
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

    #[DataProvider("providerMiddlewares")]
    public function testMiddlewares(ConsoleTester $I, Example $example): void
    {
        /** @var list<string> */
        $argv = $example["argv"];

        $terminal = $I->createTerminal($argv);

        $container = $I->grabContainer();

        $application = new Application($container);

        $application->addCommand(TrueCommand::class);
        $application->addCommand(FalseCommand::class);

        try {
            $application->handle($terminal);

            $I->assertTrue($example["shouldPass"]);
        } catch (CommandNotFoundException $e) {
            $I->assertFalse($example["shouldPass"]);
        }
    }

    protected function providerMiddlewares(): array
    {
        return [
            [
                "argv"       => ["cli.php", "middleware:true"],
                "shouldPass" => true,
            ],

            [
                "argv"       => ["cli.php", "middleware:false"],
                "shouldPass" => false,
            ],
        ];
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

        $application->addCommand(TrueCommand::class);
        $application->addCommand(MathCommand::class);

        $I->assertInstanceOf(
            MathCommand::class,
            $application->getCommand("math:add")
        );

        $I->assertInstanceOf(
            TrueCommand::class,
            $application->getCommand("middleware:true")
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

        $application->addCommand(TrueCommand::class);
        $application->addCommand(MathCommand::class);

        $commands = $application->getCommands();

        $I->assertArrayHasKey(
            "math:add",
            $commands
        );

        $I->assertArrayHasKey(
            "middleware:true",
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
