<?php

namespace Tests\Unit\Twig;

use Centum\Http\Csrf;
use Centum\Twig\CsrfExtension;
use Mockery;
use Mockery\MockInterface;
use Tests\UnitTester;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

class CsrfExtensionCest
{
    public function test(UnitTester $I): void
    {
        $csrf = Mockery::mock(
            Csrf::class,
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
}
