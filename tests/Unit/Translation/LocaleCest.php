<?php

namespace Tests\Console;

use Centum\Translation\Locale;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Translation\Locale
 */
final class LocaleCest
{
    public function testGetCode(UnitTester $I): void
    {
        $locale = new Locale(
            "en",
            []
        );

        $I->assertEquals(
            "en",
            $locale->getCode()
        );
    }

    public function testGetTranslations(UnitTester $I): void
    {
        $translations = [
            "_" => [
                "brand" => "New Project",
            ],

            "_partials/footer" => [
                "copyright" => "Copyright notice goes here.",
            ],
        ];

        $locale = new Locale(
            "en",
            $translations
        );

        $I->assertEquals(
            $translations,
            $locale->getTranslations()
        );
    }

    public function testFlattenKeys(UnitTester $I): void
    {
        $translations = [
            "_" => [
                "brand" => "New Project",
            ],

            "_partials/header" => [],

            "_partials/footer" => [
                "copyright" => "Copyright notice goes here.",
            ],
        ];

        $locale = new Locale(
            "en",
            $translations
        );

        $I->assertEquals(
            [
                "_.brand",
                "_partials/footer.copyright",
            ],
            $locale->flattenKeys()
        );
    }
}
