<?php

namespace Tests\Unit\Validator\Type;

use ArrayIterator;
use Centum\Validator\Type\IsIterable;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

class IsIterableCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsIterable();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            [[1, 2, 3]],
            [new ArrayIterator([1, 2, 3])],
            [(function () {
                yield 1;
            })()],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsIterable();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not iterable."],
            $violations
        );
    }

    protected function providerBad(): array
    {
        return [
            [1],
            [new stdClass()],
        ];
    }
}
