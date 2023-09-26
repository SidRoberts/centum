<?php

namespace Tests\Unit\Router\Replacements;

use Centum\Router\Replacements\AnyReplacement;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Router\Replacements\AnyReplacement
 */
final class AnyReplacementCest
{
    public function testGetIdentifier(UnitTester $I): void
    {
        $replacement = new AnyReplacement();

        $I->assertSame(
            "any",
            $replacement->getIdentifier()
        );
    }



    public function test(UnitTester $I): void
    {
        $value = "a";

        $replacement = new AnyReplacement();

        $I->assertRouterReplacementMatches($replacement, $value);

        $I->assertRouterReplacementFilterEquals($replacement, $value, $value);
    }

    public function testBad(UnitTester $I): void
    {
        $value = "";

        $replacement = new AnyReplacement();

        $I->assertRouterReplacementDoesNotMatch($replacement, $value);
    }
}
