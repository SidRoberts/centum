<?php

namespace Tests\Unit\Router\Replacements;

use Centum\Interfaces\Router\ReplacementInterface;
use Centum\Router\Replacements\CharacterReplacement;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Router\Replacements\CharacterReplacement
 */
final class CharacterReplacementCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $replacement = $I->mock(CharacterReplacement::class);

        $I->assertInstanceOf(ReplacementInterface::class, $replacement);
    }



    public function testGetIdentifier(UnitTester $I): void
    {
        $replacement = new CharacterReplacement();

        $I->assertSame(
            "char",
            $replacement->getIdentifier()
        );
    }



    public function test(UnitTester $I): void
    {
        $value = "a";

        $replacement = new CharacterReplacement();

        $I->assertRouterReplacementMatches($replacement, $value);

        $I->assertRouterReplacementEquals($replacement, $value, $value);
    }

    public function testBad(UnitTester $I): void
    {
        $value = "abc";

        $replacement = new CharacterReplacement();

        $I->assertRouterReplacementDoesNotMatch($replacement, $value);
    }
}
