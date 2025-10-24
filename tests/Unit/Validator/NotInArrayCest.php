<?php

namespace Tests\Unit\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;
use Centum\Validator\NotInArray;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\NotInArray
 */
final class NotInArrayCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $validator = $I->mock(NotInArray::class);

        $I->assertInstanceOf(ValidatorInterface::class, $validator);
    }



    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $disallowedValues = [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
        ];

        $validator = new NotInArray($disallowedValues);

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    /**
     * @return array<array{0: mixed}>
     */
    protected function providerGood(): array
    {
        return [
            ["Saturday"],
            ["Sunday"],
            [""],
            [false],
            [null],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $disallowedValues = [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
        ];

        $validator = new NotInArray($disallowedValues);

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is in the list of disallowed values."]
        );
    }

    /**
     * @return array<array{0: string}>
     */
    protected function providerBad(): array
    {
        return [
            ["Monday"],
            ["Tuesday"],
            ["Wednesday"],
            ["Thursday"],
            ["Friday"],
        ];
    }
}
