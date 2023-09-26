<?php

namespace Tests\Unit\Container\Exception;

use Centum\Container\Exception\FormFieldNotFoundException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Container\Exception\FormFieldNotFoundException
 */
final class FormFieldNotFoundExceptionCest
{
    public function test(UnitTester $I): void
    {
        $name = "username";

        $exception = new FormFieldNotFoundException($name);

        $I->assertEquals(
            $name,
            $exception->getName()
        );
    }
}
