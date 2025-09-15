<?php

namespace Tests\Unit\Router\Replacements;

use Centum\Router\Replacements\Uuid4Replacement;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Router\Replacements\Uuid4Replacement
 */
final class Uuid4ReplacementCest
{
    public function testGetIdentifier(UnitTester $I): void
    {
        $replacement = new Uuid4Replacement();

        $I->assertSame(
            "uuid4",
            $replacement->getIdentifier()
        );
    }



    public function test(UnitTester $I): void
    {
        $value = "00000000-0000-0000-0000-000000000000";

        $replacement = new Uuid4Replacement();

        $I->assertRouterReplacementMatches($replacement, $value);

        $I->assertRouterReplacementFilterEquals($replacement, $value, $value);
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        /** @var string */
        $value = $example["value"];

        $replacement = new Uuid4Replacement();

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
