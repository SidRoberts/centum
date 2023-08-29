<?php

namespace Tests\Unit\Container\Exception;

use Centum\Container\Exception\InstantiateInterfaceException;
use Tests\Support\UnitTester;
use Throwable;

/**
 * @covers \Centum\Container\Exception\InstantiateInterfaceException
 */
class InstantiateInterfaceExceptionCest
{
    public function test(UnitTester $I): void
    {
        $interface = Throwable::class;

        $exception = new InstantiateInterfaceException($interface);

        $I->assertEquals(
            $interface,
            $exception->getInterface()
        );
    }
}
