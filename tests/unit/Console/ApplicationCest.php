<?php

namespace Tests\Console;

use Centum\Console\Application;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\InvalidFilterException;
use Centum\Console\Exception\InvalidMiddlewareException;
use Centum\Container\Container;
use Codeception\Example;
use Tests\Console\Command\ErrorCommand;
use Tests\Console\Command\FilterCommand;
use Tests\Console\Command\InvalidFiltersCommand;
use Tests\Console\Command\InvalidMiddlewaresCommand;
use Tests\Console\Command\MainCommand;
use Tests\Console\Command\MathCommand;
use Tests\Console\Command\Middleware\FalseCommand;
use Tests\Console\Command\Middleware\Multiple1Command;
use Tests\Console\Command\Middleware\Multiple2Command;
use Tests\Console\Command\Middleware\TrueCommand;
use Tests\Console\Command\ProblematicCommand;
use Tests\UnitTester;

class ApplicationCest
{
    public function basicHandle(UnitTester $I): void
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

        $terminal = $I->getTerminal($argv);

        $exitCode = $application->handle($terminal);

        $I->assertEquals(
            "main page",
            $I->getStdoutContent()
        );
    }

    public function filters(UnitTester $I): void
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

        $terminal = $I->getTerminal($argv);

        $exitCode = $application->handle($terminal);

        $I->assertEquals(
            246,
            $I->getStdoutContent()
        );
    }

    /**
     * @dataProvider middlewaresProvider
     */
    public function middlewares(UnitTester $I, Example $example): void
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(
            new TrueCommand()
        );

        $application->addCommand(
            new FalseCommand()
        );

        $application->addCommand(
            new Multiple1Command()
        );

        $application->addCommand(
            new Multiple2Command()
        );



        $argv = $example["argv"];

        $terminal = $I->getTerminal($argv);

        try {
            $exitCode = $application->handle($terminal);

            $I->assertTrue($example["shouldPass"]);
        } catch (CommandNotFoundException $e) {
            $I->assertFalse($example["shouldPass"]);
        }
    }

    public function middlewaresProvider(): array
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

            [
                "argv"       => ["cli.php", "middleware:true-false"],
                "shouldPass" => false,
            ],

            [
                "argv"       => ["cli.php", "middleware:false-true"],
                "shouldPass" => false,
            ],
        ];
    }

    public function commandNotSpecified(UnitTester $I): void
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(
            new MainCommand()
        );

        $argv = [
            "cli.php",
        ];

        $terminal = $I->getTerminal($argv);

        $application->handle($terminal);

        $I->assertEquals(
            "main page",
            $I->getStdoutContent()
        );
    }

    public function commandNotFoundException(UnitTester $I): void
    {
        $container = new Container();

        $application = new Application($container);

        $argv = [
            "cli.php",
            "this:command:does:not:exist",
        ];

        $terminal = $I->getTerminal($argv);

        $I->expectThrowable(
            CommandNotFoundException::class,
            function () use ($terminal, $application) {
                $exitCode = $application->handle($terminal);
            }
        );
    }

    public function commandWithInvalidFilters(UnitTester $I): void
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(new InvalidFiltersCommand());

        $argv = [
            "cli.php",
            "invalid-filters",
        ];

        $terminal = $I->getTerminal($argv);

        $I->expectThrowable(
            InvalidFilterException::class,
            function () use ($terminal, $application) {
                $exitCode = $application->handle($terminal);
            }
        );
    }

    public function commandWithInvalidMiddlewares(UnitTester $I): void
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(new InvalidMiddlewaresCommand());

        $argv = [
            "cli.php",
            "invalid-middlewares",
        ];

        $terminal = $I->getTerminal($argv);

        $I->expectThrowable(
            InvalidMiddlewareException::class,
            function () use ($terminal, $application) {
                $exitCode = $application->handle($terminal);
            }
        );
    }

    public function getCommand(UnitTester $I): void
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
    }

    public function getCommands(UnitTester $I): void
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

    public function exceptionalHandlers(UnitTester $I): void
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

        $terminal = $I->getTerminal($argv);

        $exitCode = $application->handle($terminal);



        $I->assertEquals(
            "Something went wrong.",
            $I->getStdoutContent()
        );

        $I->assertEquals(
            1,
            $exitCode
        );
    }
}
