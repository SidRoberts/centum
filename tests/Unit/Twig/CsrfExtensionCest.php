<?php

namespace Tests\Unit\Twig;

use Centum\Interfaces\Http\Csrf\StorageInterface;
use Centum\Twig\CsrfExtension;
use Mockery\MockInterface;
use Tests\Support\UnitTester;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

/**
 * @covers \Centum\Twig\CsrfExtension
 */
final class CsrfExtensionCest
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
        $csrfStorage = $I->mock(
            StorageInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("get")
                    ->andReturn("abcdefghijklmnop");
            }
        );

        $twig = $this->getTwig();

        $twig->addExtension(
            new CsrfExtension($csrfStorage)
        );

        $I->assertEquals(
            "<input type=\"hidden\" name=\"csrf\" value=\"abcdefghijklmnop\">",
            $twig->render("csrf")
        );
    }



    public function testCsrfValue(UnitTester $I): void
    {
        $csrfStorage = $I->mock(
            StorageInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("get")
                    ->andReturn("abcdefghijklmnop");
            }
        );

        $twig = $this->getTwig();

        $twig->addExtension(
            new CsrfExtension($csrfStorage)
        );

        $I->assertEquals(
            "abcdefghijklmnop",
            $twig->render("csrfValue")
        );
    }
}
