<?php

namespace Tests\Unit\Paginator\Exception;

use Centum\Paginator\Exception\InvalidItemsPerPageException;
use Tests\Support\UnitTester;

class InvalidItemsPerPageExceptionCest
{
    public function test(UnitTester $I): void
    {
        $itemsPerPage = 0;

        $exception = new InvalidItemsPerPageException($itemsPerPage);

        $I->assertEquals(
            $itemsPerPage,
            $exception->getItemsPerPage()
        );
    }
}
