<?php

namespace Tests\Unit\Paginator\Exception;

use Centum\Paginator\Exception\InvalidMaxException;
use Tests\Support\UnitTester;

class InvalidMaxExceptionCest
{
    public function test(UnitTester $I): void
    {
        $max = -1;

        $exception = new InvalidMaxException($max);

        $I->assertEquals(
            $max,
            $exception->getMax()
        );
    }
}
