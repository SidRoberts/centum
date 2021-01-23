<?php

namespace Centum\Tests\Mvc\Router\Route;

use InvalidArgumentException;
use LogicException;
use Centum\Mvc\Router;
use Centum\Mvc\Router\Route\Converters;
use Centum\Tests\UnitTester;

class ConvertersCest
{
    public function badConverter(UnitTester $I)
    {
        $I->expectThrowable(
            InvalidArgumentException::class,
            function () {
                $converters = new Converters(
                    [
                        "example" => Router::class,
                    ]
                );
            }
        );
    }

    public function immutabilitySet(UnitTester $I)
    {
        $converters = new Converters(
            []
        );

        $I->expectThrowable(
            LogicException::class,
            function () use ($converters) {
                $converters["example"] = null;
            }
        );
    }

    public function immutabilityUnset(UnitTester $I)
    {
        $converters = new Converters(
            []
        );

        $I->expectThrowable(
            LogicException::class,
            function () use ($converters) {
                unset($converters["example"]);
            }
        );
    }
}
