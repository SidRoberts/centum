<?php

namespace Tests\Unit\Container\Exception;

use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Interfaces\Container\ParameterInterface;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Container\Exception\UnresolvableParameterException
 */
final class UnresolvableParameterExceptionCest
{
    public function test(UnitTester $I): void
    {
        $parameter = $I->mock(ParameterInterface::class);

        $exception = new UnresolvableParameterException($parameter);

        $I->assertSame(
            $parameter,
            $exception->getParameter()
        );
    }
}
