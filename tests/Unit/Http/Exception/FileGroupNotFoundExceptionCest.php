<?php

namespace Tests\Unit\Http\Exception;

use Centum\Http\Exception\FileGroupNotFoundException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Exception\FileGroupNotFoundException
 */
final class FileGroupNotFoundExceptionCest
{
    public function test(UnitTester $I): void
    {
        $id = "bleh";

        $exception = new FileGroupNotFoundException($id);

        $I->assertEquals(
            $id,
            $exception->getID()
        );
    }
}
