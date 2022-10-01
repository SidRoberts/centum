<?php

namespace Tests\Unit\Validator\Type;

use ArrayIterator;
use Centum\Validator\Type\IsCountable;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

class IsCountableCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsCountable();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    protected function providerGood(): array
    {
        return [
            [[1, 2, 3]],
            [new ArrayIterator(['foo', 'bar', 'baz'])],
            [new ArrayIterator()],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsCountable();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not countable."]
        );
    }

    protected function providerBad(): array
    {
        return [
            [new stdClass()],
        ];
    }
}
