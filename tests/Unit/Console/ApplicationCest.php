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
use Throwable;

class ApplicationCest
{
    protected Application $application;



    public function _before(UnitTester $I): void
    {
        $container = new Container();

        $this->application = new Application($container);

        $this->application->addCommand(
            new MainCommand()
        );

        $this->application->addCommand(
            new FilterCommand()
        );

        $this->application->addCommand(
            new TrueCommand()
        );

        $this->application->addCommand(
            new FalseCommand()
        );

        $this->application->addCommand(
            new ProblematicCommand()
        );

        $this->application->addCommand(
            new InvalidFiltersCommand()
        );

        $this->application->addCommand(
            new MathCommand()
        );
    }



    public function testBasicHandle(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "",
        ];

        $terminal = $I->createTerminal($argv);

        $this->application->handle($terminal);

        $I->assertStdoutEquals(
            "main page"
        );
    }

    public function testFilters(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "filter:double",
            "--i",
            "123",
        ];

        $terminal = $I->createTerminal($argv);

        $this->application->handle($terminal);

        $I->assertStdoutEquals(
            "246"
        );
    }

    public function testFiltersException(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "filter:double",
        ];

        $terminal = $I->createTerminal($argv);

        $application = $this->application;

        $I->expectThrowable(
            new ParamNotFoundException("i"),
            function () use ($application, $terminal): void {
                $application->handle($terminal);
            }
        );
    }

    #[DataProvider("providerMiddlewares")]
    public function testMiddlewares(UnitTester $I, Example $example): void
    {
        /** @var list<string> */
        $argv = $example["argv"];

        $terminal = $I->createTerminal($argv);

        try {
            $this->application->handle($terminal);

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
        $argv = [
            "cli.php",
        ];

        $terminal = $I->createTerminal($argv);

        $this->application->handle($terminal);

        $I->assertStdoutEquals(
            "main page"
        );
    }

    public function testCommandNotFoundException(UnitTester $I): void
    {
        $name = "this:command:does:not:exist";

        $argv = [
            "cli.php",
            $name,
        ];

        $terminal = $I->createTerminal($argv);

        $application = $this->application;

        $I->expectThrowable(
            new CommandNotFoundException($name),
            function () use ($application, $terminal): void {
                $application->handle($terminal);
            }
        );
    }

    public function testCommandWithInvalidFilters(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "invalid-filters",
        ];

        $terminal = $I->createTerminal($argv);

        $application = $this->application;

        $I->expectThrowable(
            new InvalidFilterException($terminal),
            function () use ($application, $terminal): void {
                $application->handle($terminal);
            }
        );
    }

    public function testGetCommand(UnitTester $I): void
    {
        $I->assertInstanceOf(
            MathCommand::class,
            $this->application->getCommand("math:add")
        );

        $I->assertInstanceOf(
            FilterCommand::class,
            $this->application->getCommand("filter:double")
        );

        $application = $this->application;

        $I->expectThrowable(
            OutOfRangeException::class,
            function () use ($application): void {
                $application->getCommand("doesnt-exist");
            }
        );
    }

    public function testGetCommands(UnitTester $I): void
    {
        $commands = $this->application->getCommands();

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
        $this->application->addExceptionHandler(
            Throwable::class,
            new ErrorCommand()
        );



        $argv = [
            "cli.php",
            "problematic",
        ];

        $terminal = $I->createTerminal($argv);

        $exitCode = $this->application->handle($terminal);



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
        $application = $this->application;

        $command = new BadNameCommand();

        $I->expectThrowable(
            new InvalidCommandNameException($command),
            function () use ($application, $command): void {
                $application->addCommand($command);
            }
        );
    }
}
