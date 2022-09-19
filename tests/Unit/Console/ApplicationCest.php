<?php

namespace Tests\Unit\Console;

use Centum\Console\Application;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\InvalidCommandNameException;
use Centum\Console\Exception\InvalidFilterException;
use Centum\Console\Exception\ParamNotFoundException;
use Centum\Container\Container;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use OutOfRangeException;
use Tests\Support\Commands\BadNameCommand;
use Tests\Support\Commands\ErrorCommand;
use Tests\Support\Commands\FilterCommand;
use Tests\Support\Commands\InvalidFiltersCommand;
use Tests\Support\Commands\MainCommand;
use Tests\Support\Commands\MathCommand;
use Tests\Support\Commands\Middleware\FalseCommand;
use Tests\Support\Commands\Middleware\TrueCommand;
use Tests\Support\Commands\ProblematicCommand;
use Tests\Support\UnitTester;

class ApplicationCest
{
    public function testBasicHandle(UnitTester $I): void
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(
            new MainCommand()
        );



        $argv = [
            "cli.php",
            "",
        ];

        $terminal = $I->createTerminal($argv);

        $application->handle($terminal);

        $I->assertStdoutEquals(
            "main page"
        );
    }

    public function testFilters(UnitTester $I): void
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(
            new FilterCommand()
        );



        $argv = [
            "cli.php",
            "filter:double",
            "--i",
            "123",
        ];

        $terminal = $I->createTerminal($argv);

        $application->handle($terminal);

        $I->assertStdoutEquals(
            "246"
        );
    }

    public function testFiltersException(UnitTester $I): void
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(
            new FilterCommand()
        );



        $argv = [
            "cli.php",
            "filter:double",
        ];

        $terminal = $I->createTerminal($argv);

        $I->expectThrowable(
            new ParamNotFoundException(),
            function () use ($application, $terminal): void {
                $application->handle($terminal);
            }
        );
    }

    #[DataProvider("providerMiddlewares")]
    public function testMiddlewares(UnitTester $I, Example $example): void
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(
            new TrueCommand()
        );

        $application->addCommand(
            new FalseCommand()
        );



        /** @var list<string> */
        $argv = $example["argv"];

        $terminal = $I->createTerminal($argv);

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

    public function testCommandNotSpecified(UnitTester $I): void
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(
            new MainCommand()
        );

        $argv = [
            "cli.php",
        ];

        $terminal = $I->createTerminal($argv);

        $application->handle($terminal);

        $I->assertStdoutEquals(
            "main page"
        );
    }

    public function testCommandNotFoundException(UnitTester $I): void
    {
        $container = new Container();

        $application = new Application($container);

        $argv = [
            "cli.php",
            "this:command:does:not:exist",
        ];

        $terminal = $I->createTerminal($argv);

        $I->expectThrowable(
            CommandNotFoundException::class,
            function () use ($application, $terminal): void {
                $application->handle($terminal);
            }
        );
    }

    public function testCommandWithInvalidFilters(UnitTester $I): void
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(new InvalidFiltersCommand());

        $argv = [
            "cli.php",
            "invalid-filters",
        ];

        $terminal = $I->createTerminal($argv);

        $I->expectThrowable(
            InvalidFilterException::class,
            function () use ($application, $terminal): void {
                $application->handle($terminal);
            }
        );
    }

    public function testGetCommand(UnitTester $I): void
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(new FilterCommand());
        $application->addCommand(new MathCommand());

        $I->assertInstanceOf(
            MathCommand::class,
            $application->getCommand("math:add")
        );

        $I->assertInstanceOf(
            FilterCommand::class,
            $application->getCommand("filter:double")
        );

        $I->expectThrowable(
            OutOfRangeException::class,
            function () use ($application): void {
                $application->getCommand("doesnt-exist");
            }
        );
    }

    public function testGetCommands(UnitTester $I): void
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(new FilterCommand());
        $application->addCommand(new MathCommand());

        $commands = $application->getCommands();

        $I->assertArrayHasKey(
            "math:add",
            $commands
        );

        $I->assertArrayHasKey(
            "filter:double",
            $commands
        );
    }

    public function testExceptionalHandlers(UnitTester $I): void
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(
            new ProblematicCommand()
        );

        $application->addExceptionHandler(
            \Throwable::class,
            new ErrorCommand()
        );



        $argv = [
            "cli.php",
            "problematic",
        ];

        $terminal = $I->createTerminal($argv);

        $exitCode = $application->handle($terminal);



        $I->assertStdoutEquals(
            "Something went wrong. Exception was thrown with the message \"I'm being difficult.\"."
        );

        $I->assertEquals(
            1,
            $exitCode
        );
    }

    public function testValidCommandName(UnitTester $I): void
    {
        $container = new Container();

        $application = new Application($container);

        $command = new BadNameCommand();

        $I->expectThrowable(
            new InvalidCommandNameException($command),
            function () use ($application, $command): void {
                $application->addCommand($command);
            }
        );
    }
}
