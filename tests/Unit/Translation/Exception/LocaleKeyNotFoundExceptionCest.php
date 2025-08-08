<?php

namespace Tests\Unit\Translation\Exception;

use Centum\Translation\Exception\LocaleKeyNotFoundException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Translation\Exception\LocaleKeyNotFoundException
 */
final class LocaleKeyNotFoundExceptionCest
{
    public function test(UnitTester $I): void
    {
        $localeCode = "en";

        $exception = new LocaleKeyNotFoundException($localeCode);

        $I->assertEquals(
            $localeCode,
            $exception->getLocaleCode()
        );
    }
}
