<?php

namespace Tests\Unit\Container\Resolver;

use Centum\Container\Resolver\ConsoleResolver;
use Centum\Interfaces\Container\ResolverInterface;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Container\Resolver\ConsoleResolver
 */
final class ConsoleResolverCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $resolver = $I->mock(ConsoleResolver::class);

        $I->assertInstanceOf(ResolverInterface::class, $resolver);
    }



    public function test(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }
}
