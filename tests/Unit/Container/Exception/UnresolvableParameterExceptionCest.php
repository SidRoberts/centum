<?php

namespace Tests\Unit\Container\Exception;

use Centum\Container\Exception\UnresolvableParameterException;
use ReflectionParameter;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Container\Exception\UnresolvableParameterException
 */
class UnresolvableParameterExceptionCest
{
    public function test(UnitTester $I): void
    {
        $reflectionParameter = $I->mock(ReflectionParameter::class);

        $exception = new UnresolvableParameterException($reflectionParameter);

        $I->assertSame(
            $reflectionParameter,
            $exception->getReflectionParameter()
        );
    }
}
