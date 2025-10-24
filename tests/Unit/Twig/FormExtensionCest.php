<?php

namespace Tests\Unit\Twig;

use Centum\Twig\FormExtension;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;
use Twig\Environment;
use Twig\Extension\ExtensionInterface;
use Twig\Loader\ArrayLoader;

/**
 * @covers \Centum\Twig\FormExtension
 */
final class FormExtensionCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $extension = $I->mock(FormExtension::class);

        $I->assertInstanceOf(ExtensionInterface::class, $extension);
    }



    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
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

    /**
     * @return array<array{template: string, expected: string}>
     */
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
