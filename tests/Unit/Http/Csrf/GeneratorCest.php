<?php

namespace Tests\Unit\Http\Csrf;

use Centum\Http\Csrf\Generator;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Csrf\Generator
 */
final class GeneratorCest
{
    public function testGenerateIsDifferentEveryTime(UnitTester $I): void
    {
        $generator = new Generator();

        $I->assertNotSame(
            $generator->generate(),
            $generator->generate()
        );
    }

    public function testLength(UnitTester $I): void
    {
        $generator = new Generator();

        $randomString = $generator->generate();

        $I->assertSame(
            Generator::LENGTH,
            strlen($randomString)
        );
    }
}
