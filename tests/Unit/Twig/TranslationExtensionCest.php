<?php

namespace Tests\Unit\Twig;

use Centum\Translation\Locale;
use Centum\Translation\Translator;
use Centum\Twig\TranslationExtension;
use Tests\Support\UnitTester;
use Twig\Environment;
use Twig\Extension\ExtensionInterface;
use Twig\Loader\ArrayLoader;

/**
 * @covers \Centum\Twig\TranslationExtension
 */
final class TranslationExtensionCest
{
    protected function getTwig(): Environment
    {
        $loader = new ArrayLoader(
            [
                "template" => "{{ translate('_', 'brand') }}",
            ]
        );

        return new Environment($loader);
    }



    public function testInterfaces(UnitTester $I): void
    {
        $extension = $I->mock(TranslationExtension::class);

        $I->assertInstanceOf(ExtensionInterface::class, $extension);
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



        $twig = $this->getTwig();

        $twig->addExtension(
            new TranslationExtension($translator)
        );



        $actual = $twig->render("template");

        $I->assertEquals(
            "새 프로젝트",
            $actual
        );
    }
}
