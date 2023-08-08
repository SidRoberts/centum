<?php

namespace Tests\Unit\Router\Replacements;

use Centum\Router\Replacements\IntegerReplacement;
use Tests\Support\UnitTester;

class IntegerReplacementCest
{
    public function testGetIdentifier(UnitTester $I): void
    {
        $replacement = new IntegerReplacement();

        $I->assertSame(
            "int",
            $replacement->getIdentifier()
        );
    }



    public function test(UnitTester $I): void
    {
        $value = "1";

        $replacement = new IntegerReplacement();

        $I->assertRouterReplacementMatches($replacement, $value);

        $I->assertRouterReplacementFilterEquals($replacement, $value, 1);
    }



    public function testBad(UnitTester $I): void
    {
        $value = "one";

        $replacement = new IntegerReplacement();

        $I->assertRouterReplacementDoesNotMatch($replacement, $value);
    }
}
