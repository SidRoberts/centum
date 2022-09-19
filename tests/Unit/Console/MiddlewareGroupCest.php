<?php

namespace Tests\Unit\Console;

use Centum\Console\MiddlewareGroup;
use Centum\Console\MiddlewareInterface;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\Commands\BoringCommand;
use Tests\Support\Middlewares\Console\FalseMiddleware;
use Tests\Support\Middlewares\Console\TrueMiddleware;
use Tests\Support\UnitTester;

class MiddlewareGroupCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $argv = [
            "cli.php",
            "middleware-group",
        ];

        $terminal = $I->createTerminal($argv);

        $command = new BoringCommand();

        $container = $I->getContainer();

        /** @var array<MiddlewareInterface> */
        $middlewares = $example["middlewares"];

        $group = new MiddlewareGroup($middlewares);

        /** @var bool */
        $expected = $example["expected"];

        $I->assertEquals(
            $expected,
            $group->middleware($terminal, $command, $container)
        );
    }

    protected function provider(): array
    {
        return [
            [
                "middlewares" => [
                    new TrueMiddleware(),
                    new TrueMiddleware(),
                ],
                "expected" => true,
            ],

            [
                "middlewares" => [
                    new TrueMiddleware(),
                    new FalseMiddleware(),
                ],
                "expected" => false,
            ],

            [
                "middlewares" => [
                    new FalseMiddleware(),
                    new TrueMiddleware(),
                ],
                "expected" => false,
            ],

            [
                "middlewares" => [
                    new FalseMiddleware(),
                    new FalseMiddleware(),
                ],
                "expected" => false,
            ],
        ];
    }
}