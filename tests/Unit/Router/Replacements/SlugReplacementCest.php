<?php

namespace Tests\Unit\Router\Replacements;

use Centum\Router\Replacements\SlugReplacement;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Router\Replacements\SlugReplacement
 */
final class SlugReplacementCest
{
    public function testGetIdentifier(UnitTester $I): void
    {
        $replacement = new SlugReplacement();

        $I->assertSame(
            "slug",
            $replacement->getIdentifier()
        );
    }



    public function test(UnitTester $I): void
    {
        $value = "valid-slug-123";

        $replacement = new SlugReplacement();

        $I->assertRouterReplacementMatches($replacement, $value);

        $I->assertRouterReplacementFilterEquals($replacement, $value, $value);
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        /** @var string */
        $value = $example["value"];

        $replacement = new SlugReplacement();

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
