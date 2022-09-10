<?php

namespace Tests\Unit\Validator\Type;

use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Validator\Type\IsResource;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class IsResourceCest
{
    public function testGood(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }



    /**
     * @dataProvider providerBad
     */
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsResource();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not a resource."],
            $violations
        );
    }

    protected function providerBad(): array
    {
        return [
            [true],
            [false],
            [123.456],
            [123],
            [0],
            [null],
            [new HtmlFormatter()],
            [(object) []],
            [$this],
            [new stdClass()],
            ["Sid Roberts"],
            [""],
        ];
    }
}
