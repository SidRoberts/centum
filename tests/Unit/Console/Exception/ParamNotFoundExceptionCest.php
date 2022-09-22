<?php

namespace Tests\Unit\Console\Exception;

use Centum\Console\Exception\ParamNotFoundException;
use Tests\Support\UnitTester;

class ParamNotFoundExceptionCest
{
    public function test(UnitTester $I): void
    {
        $key = "bleh";

        $exception = new ParamNotFoundException($key);

        $I->assertEquals(
            $key,
            $exception->getKey()
        );
    }
}
