<?php

namespace Tests\Unit\Twig;

use Centum\Interfaces\Http\CsrfInterface;
use Centum\Twig\CsrfExtension;
use Mockery\MockInterface;
use Tests\Support\UnitTester;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

class CsrfExtensionCest
{
    protected function getTwig(): Environment
    {
        $loader = new ArrayLoader(
            [
                "csrf"      => "{{ csrf() }}",
                "csrfValue" => "{{ csrfValue() }}",
            ]
        );

        return new Environment($loader);
    }



    public function test(UnitTester $I): void
    {
        $csrf = $I->mock(
            CsrfInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("get")
                    ->andReturn("abcdefghijklmnop");
            }
        );

        $twig = $this->getTwig();

        $twig->addExtension(
            new CsrfExtension($csrf)
        );

        $I->assertEquals(
            "<input type=\"hidden\" name=\"csrf\" value=\"abcdefghijklmnop\">",
            $twig->render("csrf")
        );
    }



    public function testCsrfValue(UnitTester $I): void
    {
        $csrf = $I->mock(
            CsrfInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("get")
                    ->andReturn("abcdefghijklmnop");
            }
        );

        $twig = $this->getTwig();

        $twig->addExtension(
            new CsrfExtension($csrf)
        );

        $I->assertEquals(
            "abcdefghijklmnop",
            $twig->render("csrfValue")
        );
    }
}
