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
    protected Environment $twig;



    public function _before(UnitTester $I): void
    {
        $loader = new ArrayLoader(
            [
                "csrf"      => "{{ csrf() }}",
                "csrfValue" => "{{ csrfValue() }}",
            ]
        );

        $this->twig = new Environment($loader);
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

        $this->twig->addExtension(
            new CsrfExtension($csrf)
        );

        $I->assertEquals(
            "<input type=\"hidden\" name=\"csrf\" value=\"abcdefghijklmnop\">",
            $this->twig->render("csrf")
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

        $this->twig->addExtension(
            new CsrfExtension($csrf)
        );

        $I->assertEquals(
            "abcdefghijklmnop",
            $this->twig->render("csrfValue")
        );
    }
}
