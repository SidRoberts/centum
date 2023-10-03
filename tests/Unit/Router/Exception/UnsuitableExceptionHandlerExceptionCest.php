<?php

namespace Tests\Unit\Router\Exception;

use Centum\Interfaces\Router\ExceptionHandlerInterface;
use Centum\Router\Exception\UnsuitableExceptionHandlerException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Router\Exception\UnsuitableExceptionHandlerException
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
