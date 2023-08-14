<?php

namespace Tests\Unit\Container\Exception;

use Centum\Container\Exception\FileGroupNotFoundException;
use Tests\Support\UnitTester;

class FileGroupNotFoundExceptionCest
{
    public function test(UnitTester $I): void
    {
        $name = "images";

        $exception = new FileGroupNotFoundException($name);

        $I->assertEquals(
            $name,
            $exception->getName()
        );
    }
}
