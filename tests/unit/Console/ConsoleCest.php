<?php

namespace Tests\Console;

use Centum\Container\Container;
use Centum\Console\Application;
use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Console\Exception\InvalidConverterException;
use Centum\Console\Exception\InvalidMiddlewareException;
use Tests\Console\Command\InvalidConvertersCommand;
use Tests\Console\Command\InvalidMiddlewaresCommand;
use Tests\Console\Command\ConverterCommand;
use Tests\Console\Command\MainCommand;
use Tests\Console\Command\MathCommand;
use Tests\Console\Command\Middleware\TrueCommand;
use Tests\Console\Command\Middleware\FalseCommand;
use Tests\Console\Command\Middleware\Multiple1Command;
use Tests\Console\Command\Middleware\Multiple2Command;
use Tests\UnitTester;
use Codeception\Example;

class ApplicationCest
{
    public function basicHandle(UnitTester $I)
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

        $stdin = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

        $exitCode = $application->handle($terminal);

        rewind($stdout);

        $I->assertEquals(
            "main page",
            stream_get_contents($stdout)
        );
    }

    public function converters(UnitTester $I)
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(
            new ConverterCommand()
        );



        $argv = [
            "cli.php",
            "converter:double",
            "--i",
            "123",
        ];

        $stdin = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

        $exitCode = $application->handle($terminal);

        rewind($stdout);

        $I->assertEquals(
            246,
            stream_get_contents($stdout)
        );
    }

    /**
     * @dataProvider middlewaresProvider
     */
    public function middlewares(UnitTester $I, Example $example)
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

        $stdin = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

        try {
            $exitCode = $application->handle($terminal);

            $I->assertTrue($example["shouldPass"]);
        } catch (CommandNotFoundException $e) {
            $I->assertFalse($example["shouldPass"]);
        }
    }

    public function middlewaresProvider() : array
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

    public function commandNotSpecified(UnitTester $I)
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(
            new MainCommand()
        );

        $argv = [
            "cli.php",
        ];

        $stdin = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

        $application->handle($terminal);

        rewind($stdout);

        $I->assertEquals(
            "main page",
            stream_get_contents($stdout)
        );
    }

    public function commandNotFoundException(UnitTester $I)
    {
        $container = new Container();

        $application = new Application($container);

        $argv = [
            "cli.php",
            "this:command:does:not:exist",
        ];

        $stdin = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

        $I->expectThrowable(
            CommandNotFoundException::class,
            function () use ($terminal, $application) {
                $exitCode = $application->handle($terminal);
            }
        );
    }

    public function commandWithInvalidConverters(UnitTester $I)
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(new InvalidConvertersCommand());

        $argv = [
            "cli.php",
            "invalid-converters",
        ];

        $stdin = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

        $I->expectThrowable(
            InvalidConverterException::class,
            function () use ($terminal, $application) {
                $exitCode = $application->handle($terminal);
            }
        );
    }

    public function commandWithInvalidMiddlewares(UnitTester $I)
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(new InvalidMiddlewaresCommand());

        $argv = [
            "cli.php",
            "invalid-middlewares",
        ];

        $stdin = fopen("php://memory", "r");
        $stdout = fopen("php://memory", "w");
        $stderr = fopen("php://memory", "w");

        $terminal = new Terminal($argv, $stdin, $stdout, $stderr);

        $I->expectThrowable(
            InvalidMiddlewareException::class,
            function () use ($terminal, $application) {
                $exitCode = $application->handle($terminal);
            }
        );
    }

    public function getCommand(UnitTester $I)
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(new ConverterCommand());
        $application->addCommand(new MathCommand());

        $I->assertInstanceOf(
            MathCommand::class,
            $application->getCommand("math:add")
        );

        $I->assertInstanceOf(
            ConverterCommand::class,
            $application->getCommand("converter:double")
        );
    }

    public function getCommands(UnitTester $I)
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(new ConverterCommand());
        $application->addCommand(new MathCommand());

        $commands = $application->getCommands();

        $I->assertArrayHasKey(
            "math:add",
            $commands
        );

        $I->assertArrayHasKey(
            "converter:double",
            $commands
        );
    }
}
