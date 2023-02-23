<?php

namespace Tests\Unit\Http\Exception;

use Centum\Http\Exception\CsrfException;
use Tests\Support\UnitTester;

class CsrfExceptionCest
{
    public function testGetValue(UnitTester $I): void
    {
        $value = "qwertyuiopasdfgh";

        $exception = new CsrfException($value);

        $I->assertEquals(
            $value,
            $exception->getValue()
        );
    }

    public function testGetMessage(UnitTester $I): void
    {
        $value = "qwertyuiopasdfgh";

        $exception = new CsrfException($value);

        $I->assertEquals(
            "CSRF values did not match.",
            $exception->getMessage()
        );
    }
}
