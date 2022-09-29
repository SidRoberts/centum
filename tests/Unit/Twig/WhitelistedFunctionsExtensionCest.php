<?php

namespace Tests\Unit\Twig;

use Centum\Twig\WhitelistedFunctionsExtension;
use Codeception\Attribute\Depends;
use Tests\Support\UnitTester;
use Twig\Environment;
use Twig\Error\SyntaxError;
use Twig\Loader\ArrayLoader;

class WhitelistedFunctionsExtensionCest
{
    protected ?Environment $twig;



    public function _before(UnitTester $I): void
    {
        $loader = new ArrayLoader(
            [
                "template" => "{{ ucfirst(variable) }}",
            ]
        );

        $this->twig = new Environment($loader);
    }

    public function _after(UnitTester $I): void
    {
        $this->twig = null;
    }



    public function testUndefinedFunctionThrowsException(UnitTester $I): void
    {
        $this->twig->addExtension(
            new WhitelistedFunctionsExtension(
                []
            )
        );

        $twig = $this->twig;

        $I->expectThrowable(
            SyntaxError::class,
            function () use ($twig): void {
                $twig->render(
                    "template",
                    [
                        "variable" => "THE STRING",
                    ]
                );
            }
        );
    }



    #[Depends("testUndefinedFunctionThrowsException")]
    public function testDefinedFunction(UnitTester $I): void
    {
        $this->twig->addExtension(
            new WhitelistedFunctionsExtension(
                [
                    "ucfirst",
                ]
            )
        );

        $actual = $this->twig->render(
            "template",
            [
                "variable" => "the string",
            ]
        );

        $I->assertEquals(
            "The string",
            $actual
        );
    }
}
