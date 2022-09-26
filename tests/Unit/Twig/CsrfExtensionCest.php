<?php

namespace Tests\Unit\Twig;

use Centum\Interfaces\Http\CsrfInterface;
use Centum\Twig\CsrfExtension;
use Mockery;
use Mockery\MockInterface;
use Tests\Support\UnitTester;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

class CsrfExtensionCest
{
    public function test(UnitTester $I): void
    {
        $csrf = Mockery::mock(
            CsrfInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("get")
                    ->andReturn("abcdefghijklmnop");
            }
        );



        $loader = new ArrayLoader(
            [
                "template" => "{{ csrf() }}",
            ]
        );

        $twig = new Environment($loader);



        $twig->addExtension(
            new CsrfExtension($csrf)
        );



        $I->assertEquals(
            "<input type=\"hidden\" name=\"csrf\" value=\"abcdefghijklmnop\">",
            $twig->render("template")
        );
    }



    public function testCsrfValue(UnitTester $I): void
    {
        $csrf = Mockery::mock(
            CsrfInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("get")
                    ->andReturn("abcdefghijklmnop");
            }
        );



        $loader = new ArrayLoader(
            [
                "template" => "{{ csrfValue() }}",
            ]
        );

        $twig = new Environment($loader);



        $twig->addExtension(
            new CsrfExtension($csrf)
        );



        $I->assertEquals(
            "abcdefghijklmnop",
            $twig->render("template")
        );
    }
}
