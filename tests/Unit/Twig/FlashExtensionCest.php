<?php

namespace Tests\Unit\Twig;

use Centum\Flash\Flash;
use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Http\Session\ArraySession;
use Centum\Twig\FlashExtension;
use Tests\Support\UnitTester;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

class FlashExtensionCest
{
    protected Environment $twig;



    public function _before(UnitTester $I): void
    {
        $loader = new ArrayLoader(
            [
                "template" => "{{ flash() }}",
            ]
        );

        $this->twig = new Environment($loader);
    }



    public function test(UnitTester $I): void
    {
        $session = new ArraySession();

        $formatter = new HtmlFormatter();

        $flash = new Flash(
            $session,
            $formatter
        );



        $flash->danger("danger message");



        $this->twig->addExtension(
            new FlashExtension($flash)
        );



        $expected = "<div class=\"alert alert-danger\">danger message</div>" . PHP_EOL;

        $actual = $this->twig->render("template");

        $I->assertEquals(
            $expected,
            $actual
        );
    }
}
