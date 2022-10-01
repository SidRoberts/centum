<?php

namespace Tests\Unit\Console;

use Centum\Console\MiddlewareGroup;
use Centum\Interfaces\Console\MiddlewareInterface;
use Centum\Interfaces\Console\TerminalInterface;
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
        $terminal = $I->mock(TerminalInterface::class);

        $command = new BoringCommand();

        $container = $I->grabContainer();

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
                "middlewares" => [],
                "expected"    => true,
            ],

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

    public function testToArray(UnitTester $I): void
    {
        $trueMiddleware  = new TrueMiddleware();
        $falseMiddleware = new FalseMiddleware();

        $middlewares = [
            $trueMiddleware,
            $falseMiddleware,
        ];

        $group = new MiddlewareGroup(
            $middlewares
        );

        $I->assertSame(
            $middlewares,
            $group->toArray()
        );
    }
}