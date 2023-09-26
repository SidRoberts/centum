<?php

namespace Tests\Unit\Validator\Type;

use ArrayIterator;
use Centum\Validator\Type\IsIterable;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsIterable
 */
final class IsIterableCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsIterable();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
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

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not iterable."]
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
