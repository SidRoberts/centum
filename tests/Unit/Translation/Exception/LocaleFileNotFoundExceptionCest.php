<?php

namespace Tests\Unit\Translation\Exception;

use Centum\Translation\Exception\LocaleFileNotFoundException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Translation\Exception\LocaleFileNotFoundException
 */
final class LocaleFileNotFoundExceptionCest
{
    public function test(UnitTester $I): void
    {
        $path = "en.php";

        $exception = new LocaleFileNotFoundException($path);

        $I->assertEquals(
            $path,
            $exception->getLocalePath()
        );
    }
}
