<?php

namespace Tests\Unit\Twig;

use Centum\Twig\WhitelistedFunctionsExtension;
use Tests\Support\UnitTester;
use Twig\Environment;
use Twig\Error\SyntaxError;
use Twig\Extension\ExtensionInterface;
use Twig\Loader\ArrayLoader;

/**
 * @covers \Centum\Twig\WhitelistedFunctionsExtension
 */
final class WhitelistedFunctionsExtensionCest
{
    protected function getTwig(): Environment
    {
        $loader = new ArrayLoader(
            [
                "ucfirst" => "{{ ucfirst(variable) }}",
                "lcfirst" => "{{ lcfirst(variable) }}",
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

        return $twig;
    }



    public function testInterfaces(UnitTester $I): void
    {
        $extension = $I->mock(WhitelistedFunctionsExtension::class);

        $I->assertInstanceOf(ExtensionInterface::class, $extension);
    }



    public function testUndefinedFunctionThrowsException(UnitTester $I): void
    {
        $twig = $this->getTwig();

        $I->expectThrowable(
            SyntaxError::class,
            function () use ($twig): void {
                $twig->render(
                    "lcfirst",
                    [
                        "variable" => "THE STRING",
                    ]
                );
            }
        );
    }



    public function testDefinedFunction(UnitTester $I): void
    {
        $twig = $this->getTwig();

        $actual = $twig->render(
            "ucfirst",
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
