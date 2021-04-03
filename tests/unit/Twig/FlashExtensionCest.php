<?php

namespace Tests\Twig;

use Centum\Flash\Flash;
use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Http\Session;
use Centum\Http\Session\ArrayHandler;
use Centum\Twig\FlashExtension;
use Tests\UnitTester;
use Twig\Loader\ArrayLoader;

class FlashExtensionCest
{
    public function extension(UnitTester $I): void
    {
        $arrayHandler = new ArrayHandler();

        $session   = new Session($arrayHandler);
        $formatter = new HtmlFormatter();

        $flash = new Flash(
            $session,
            $formatter
        );



        $flash->danger("danger message");



        $loader = new ArrayLoader(
            [
                "template" => "{{ flash() }}",
            ]
        );

        $twig = new \Twig\Environment(
            $loader
        );



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
