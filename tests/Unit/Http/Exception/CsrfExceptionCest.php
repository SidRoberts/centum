<?php

namespace Tests\Unit\Http\Exception;

use Centum\Http\Exception\CsrfException;
use Tests\Support\UnitTester;

class CsrfExceptionCest
{
    public function test(UnitTester $I): void
    {
        $value = "qwertyuiopasdfgh";

        $exception = new CsrfException($value);

        $I->assertEquals(
            $value,
            $exception->getValue()
        );
    }
}
