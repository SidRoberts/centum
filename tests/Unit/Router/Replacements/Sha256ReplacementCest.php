<?php

namespace Tests\Unit\Router\Replacements;

use Centum\Router\Replacements\Sha256Replacement;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Router\Replacements\Sha256Replacement
 */
final class Sha256ReplacementCest
{
    public function testGetIdentifier(UnitTester $I): void
    {
        $replacement = new Sha256Replacement();

        $I->assertSame(
            "sha256",
            $replacement->getIdentifier()
        );
    }



    public function test(UnitTester $I): void
    {
        $value = "a813584d9019c483587aad0b1e576ecec3ac922152b8826fd1b641fd6f44814d";

        $replacement = new Sha256Replacement();

        $I->assertRouterReplacementMatches($replacement, $value);

        $I->assertRouterReplacementEquals($replacement, $value, $value);
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        /** @var string */
        $value = $example["value"];

        $replacement = new Sha256Replacement();

        $I->assertRouterReplacementDoesNotMatch($replacement, $value);
    }

    protected function providerBad(): array
    {
        return [
            [
                "value" => "",
            ],

            [
                "value" => "-not-valid",
            ],

            [
                "value" => "not-valid-",
            ],

            [
                "value" => "not_valid",
            ],

            [
                "value" => "NOT-VALID",
            ],
        ];
    }
}
