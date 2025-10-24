<?php

namespace Tests\Unit\Container;

use Centum\Container\ResolverGroup;
use Centum\Interfaces\Container\ResolverGroupInterface;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Container\ResolverGroup
 */
final class ResolverGroupCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $resolverGroup = $I->mock(ResolverGroup::class);

        $I->assertInstanceOf(ResolverGroupInterface::class, $resolverGroup);
    }



    public function test(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }
}
