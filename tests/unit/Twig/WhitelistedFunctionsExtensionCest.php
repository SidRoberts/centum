<?php

namespace Tests\Twig;

use Tests\UnitTester;
use Centum\Twig\WhitelistedFunctionsExtension;
use Twig\Environment;
use Twig\Error\SyntaxError;
use Twig\Loader\ArrayLoader;

class WhitelistedFunctionsExtensionCest
{
    public function testUndefinedFunctionThrowsException(UnitTester $I)
    {
        $loader = new ArrayLoader(
            [
                "template" => "{{ lcfirst(variable) }}",
            ]
        );

        $twig = new Environment($loader);



        $twig->addExtension(
            new WhitelistedFunctionsExtension(
                [
                    "ucfirst",
                ]
            )
        );



        $I->expectThrowable(
            SyntaxError::class,
            function () use ($twig) {
                $twig->render(
                    "template",
                    [
                        "variable" => "THE STRING",
                    ]
                );
            }
        );
    }



    public function testDefinedFunction(UnitTester $I)
    {
        $loader = new ArrayLoader(
            [
                "template" => "{{ ucfirst(variable) }}",
            ]
        );

        $twig = new Environment($loader);



        $twig->addExtension(
            new WhitelistedFunctionsExtension(
                [
                    "ucfirst",
                ]
            )
        );



        $actual = $twig->render(
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
