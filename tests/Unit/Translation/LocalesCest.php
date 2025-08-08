<?php

namespace Tests\Unit\Translation;

use Centum\Translation\Locales;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Translation\Locales
 */
final class LocalesCest
{
    public function testGetAvailableCodes(UnitTester $I): void
    {
        $locales = new Locales(
            [
                "en"    => "en.php",
                "en_GB" => "en_GB.php",
                "ko"    => "ko.php",
            ]
        );

        $I->assertEquals(
            ["en", "en_GB", "ko"],
            $locales->getAvailableCodes()
        );
    }
}
