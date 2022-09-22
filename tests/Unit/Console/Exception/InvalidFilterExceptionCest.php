<?php

namespace Tests\Unit\Console\Exception;

use Centum\Console\Exception\InvalidFilterException;
use Centum\Container\Container;
use Tests\Support\UnitTester;

class InvalidFilterExceptionCest
{
    public function test(UnitTester $I): void
    {
        $invalidFilter = new Container();

        $exception = new InvalidFilterException($invalidFilter);

        $I->assertSame(
            $invalidFilter,
            $exception->getInvalidFilter()
        );
    }
}