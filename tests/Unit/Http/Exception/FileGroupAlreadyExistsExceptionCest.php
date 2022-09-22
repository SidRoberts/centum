<?php

namespace Tests\Unit\Http\Exception;

use Centum\Http\Exception\FileGroupAlreadyExistsException;
use Tests\Support\UnitTester;

class FileGroupAlreadyExistsExceptionCest
{
    public function test(UnitTester $I): void
    {
        $id = "images";

        $exception = new FileGroupAlreadyExistsException($id);

        $I->assertEquals(
            $id,
            $exception->getID()
        );
    }
}
