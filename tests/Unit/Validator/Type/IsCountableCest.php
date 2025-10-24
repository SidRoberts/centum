<?php

namespace Tests\Unit\Validator\Type;

use ArrayIterator;
use Centum\Interfaces\Validator\ValidatorInterface;
use Centum\Validator\Type\IsCountable;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Countable;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsCountable
 */
final class IsCountableCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $validator = $I->mock(IsCountable::class);

        $I->assertInstanceOf(ValidatorInterface::class, $validator);
    }



    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsCountable();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    /**
     * @return array<array{0: array|Countable}>
     */
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

    /**
     * @return array<array{0: mixed}>
     */
    protected function providerBad(): array
    {
        return [
            [new stdClass()],
        ];
    }
}
