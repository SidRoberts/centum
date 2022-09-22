<?php

namespace Tests\Unit\Paginator\Exception;

use Centum\Paginator\Exception\InvalidTotalException;
use Tests\Support\UnitTester;

class InvalidTotalExceptionCest
{
    public function test(UnitTester $I): void
    {
        $total = -1;

        $exception = new InvalidTotalException($total);

        $I->assertEquals(
            $total,
            $exception->getTotal()
        );
    }
}
