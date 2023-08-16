<?php

namespace Tests\Unit\Container\Exception;

use Centum\Container\Exception\FormFieldNotFoundException;
use Tests\Support\UnitTester;

class FormFieldNotFoundExceptionCest
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