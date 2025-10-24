<?php

namespace Tests\Unit\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;
use Centum\Validator\Callback;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Callback
 */
final class CallbackCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $validator = $I->mock(Callback::class);

        $I->assertInstanceOf(ValidatorInterface::class, $validator);
    }



    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new Callback(
            function (mixed $value): array {
                if (!is_string($value)) {
                    return [
                        "Value is not a string.",
                    ];
                }

                return [];
            }
        );

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    /**
     * @return array<array{0: string}>
     */
    protected function providerGood(): array
    {
        return [
            ["SidRoberts"],
            ["안녕"],
            ["123"],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new Callback(
            function (mixed $value): array {
                if (!is_string($value)) {
                    return [
                        "Value is not a string.",
                    ];
                }

                return [];
            }
        );

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a string."]
        );
    }

    /**
     * @return array<array{0: mixed}>
     */
    protected function providerBad(): array
    {
        return [
            [true],
            [null],
            [123],
            [[]],
            [new stdClass()],
        ];
    }
}
