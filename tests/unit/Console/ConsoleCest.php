<?php

namespace Centum\Tests\Console;

use Centum\Container\Container;
use Centum\Console\Application;
use Centum\Console\Command;
use Centum\Console\Terminal\BufferedTerminal;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Tests\Console\Command\ConverterCommand;
use Centum\Tests\Console\Command\MainCommand;
use Centum\Tests\Console\Command\HttpMethodGetCommand;
use Centum\Tests\Console\Command\HttpMethodPostCommand;
use Centum\Tests\Console\Command\Middleware\TrueCommand;
use Centum\Tests\Console\Command\Middleware\FalseCommand;
use Centum\Tests\Console\Command\Middleware\Multiple1Command;
use Centum\Tests\Console\Command\Middleware\Multiple2Command;
use Centum\Tests\Console\Command\RequirementsCommand;
use Centum\Tests\UnitTester;
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



        $terminal = new BufferedTerminal(
            [
                "",
            ]
        );

        $exitCode = $application->handle($terminal);

        $I->assertEquals(
            "main page",
            $terminal->getContent()
        );
    }

    public function converters(UnitTester $I)
    {
        $container = new Container();

        $application = new Application($container);

        $application->addCommand(
            new ConverterCommand()
        );



        $terminal = new BufferedTerminal(
            [
                "converter:double",
                "--i",
                "123",
            ]
        );

        $exitCode = $application->handle($terminal);

        $I->assertEquals(
            246,
            $terminal->getContent()
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



        $terminal = new BufferedTerminal(
            $example["argv"]
        );

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
                "argv"       => ["middleware:true"],
                "shouldPass" => true,
            ],

            [
                "argv"       => ["middleware:false"],
                "shouldPass" => false,
            ],

            [
                "argv"       => ["middleware:true-false"],
                "shouldPass" => false,
            ],

            [
                "argv"       => ["middleware:false-true"],
                "shouldPass" => false,
            ],
        ];
    }

    public function commandNotFoundException(UnitTester $I)
    {
        $container = new Container();

        $application = new Application($container);

        $terminal = new BufferedTerminal(
            [
                "this:command:does:not:exist",
            ]
        );

        $I->expectThrowable(
            CommandNotFoundException::class,
            function () use ($terminal, $application) {
                $exitCode = $application->handle($terminal);
            }
        );
    }
}
