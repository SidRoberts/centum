<?php

namespace Tests\Unit\Twig;

use Centum\Flash\Flash;
use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Flash\Storage;
use Centum\Http\Session\ArraySession;
use Centum\Twig\FlashExtension;
use Tests\Support\UnitTester;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

/**
 * @covers \Centum\Twig\FlashExtension
 */
class FlashExtensionCest
{
    protected function getTwig(): Environment
    {
        $loader = new ArrayLoader(
            [
                "template" => "{{ flash() }}",
            ]
        );

        return new Environment($loader);
    }



    public function test(UnitTester $I): void
    {
        $session = new ArraySession();

        $storage = new Storage($session);

        $formatter = new HtmlFormatter();

        $flash = new Flash(
            $storage,
            $formatter
        );



        $flash->danger("danger message");



        $twig = $this->getTwig();

        $twig->addExtension(
            new FlashExtension($flash)
        );



        $expected = "<div class=\"alert alert-danger\">danger message</div>" . PHP_EOL;

        $actual = $twig->render("template");

        $I->assertEquals(
            $expected,
            $actual
        );
    }
}
