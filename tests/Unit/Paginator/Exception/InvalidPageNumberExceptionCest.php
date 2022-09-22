<?php

namespace Tests\Unit\Paginator\Exception;

use Centum\Paginator\Exception\InvalidPageNumberException;
use Tests\Support\UnitTester;

class InvalidPageNumberExceptionCest
{
    public function test(UnitTester $I): void
    {
        $pageNumber = 0;

        $exception = new InvalidPageNumberException($pageNumber);

        $I->assertEquals(
            $pageNumber,
            $exception->getPageNumber()
        );
    }
}
