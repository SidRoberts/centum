<?php

namespace Tests\Unit\Container\Exception;

use Centum\Container\Exception\UnresolvableParameterException;
use Tests\Support\UnitTester;

class UnresolvableParameterExceptionCest
{
    public function test(UnitTester $I): void
    {
        $name = "bleh";

        $exception = new UnresolvableParameterException($name);

        $I->assertEquals(
            $name,
            $exception->getName()
        );
    }
}
