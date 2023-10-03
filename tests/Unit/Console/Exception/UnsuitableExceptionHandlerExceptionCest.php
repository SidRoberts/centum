<?php

namespace Tests\Unit\Console\Exception;

use Centum\Console\Exception\UnsuitableExceptionHandlerException;
use Centum\Interfaces\Console\ExceptionHandlerInterface;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Console\Exception\UnsuitableExceptionHandlerException
 */
final class UnsuitableExceptionHandlerExceptionCest
{
    public function test(UnitTester $I): void
    {
        $exceptionHandler = $I->mock(ExceptionHandlerInterface::class);

        $exception = new UnsuitableExceptionHandlerException($exceptionHandler);

        $I->assertEquals(
            $exceptionHandler,
            $exception->getExceptionHandler()
        );
    }
}
