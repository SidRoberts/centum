<?php

namespace Tests\Twig;

use Centum\Twig\FormExtension;
use Codeception\Example;
use Tests\UnitTester;
use Twig\Environment;
use Twig\Extension;
use Twig\Loader\ArrayLoader;

class FormExtensionCest
{
    /**
     * @dataProvider provider
     */
    public function extension(UnitTester $I, Example $example): void
    {
        $loader = new ArrayLoader(
            [
                "template" => $example["template"],
            ]
        );

        $twig = new Environment($loader);



        $twig->addExtension(
            new FormExtension()
        );



        $actual = $twig->render("template");



        $I->assertEquals(
            $example["expected"],
            $actual
        );
    }

    protected function provider(): array
    {
        return [
            [
                "template" => "{{ form_start() }}{{ form_end() }}",
                "expected" => "<form method=\"GET\" action=\"\"></form>",
            ],

            [
                "template" => "{{ form_start(\"POST\") }}{{ form_end() }}",
                "expected" => "<form method=\"POST\" action=\"\"></form>",
            ],

            [
                "template" => "{{ form_start(\"POST\", \"/login\") }}{{ form_end() }}",
                "expected" => "<form method=\"POST\" action=\"/login\"></form>",
            ],

            [
                "template" => "{{ form_start(\"PUT\") }}{{ form_end() }}",
                "expected" => "<form method=\"POST\" action=\"\">" . PHP_EOL . "<input type=\"hidden\" name=\"_method\" value=\"PUT\"></form>",
            ],

            [
                "template" => "{{ form_start(\"POST\") }}{{ form_end() }}",
                "expected" => "<form method=\"POST\" action=\"\"></form>",
            ],
        ];
    }
}
