<?php

namespace Tests\Unit\Translation;

use Centum\Interfaces\Translation\TranslatorInterface;
use Centum\Translation\Locale;
use Centum\Translation\Translator;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Translation\Translator
 */
final class TranslatorCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $translator = $I->mock(Translator::class);

        $I->assertInstanceOf(TranslatorInterface::class, $translator);
    }



    public function test(UnitTester $I): void
    {
        $locale = new Locale(
            "ko",
            [
                "_" => [
                    "brand" => "새 프로젝트",
                ],
            ]
        );

        $translator = new Translator($locale);



        $actual = $translator->translate("_", "brand");

        $I->assertEquals(
            "새 프로젝트",
            $actual
        );
    }
}
