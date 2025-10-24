<?php

namespace Tests\Unit\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;
use Centum\Validator\InArray;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\InArray
 */
final class InArrayCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $validator = $I->mock(InArray::class);

        $I->assertInstanceOf(ValidatorInterface::class, $validator);
    }



    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $allowedValues = [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
        ];

        $validator = new InArray($allowedValues);

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
            ["Monday"],
            ["Tuesday"],
            ["Wednesday"],
            ["Thursday"],
            ["Friday"],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $allowedValues = [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
        ];

        $validator = new InArray($allowedValues);

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not in the list of allowed values."]
        );
    }

    /**
     * @return array<array{0: string}>
     */
    protected function providerBad(): array
    {
        return [
            ["Saturday"],
            ["Sunday"],
        ];
    }
}
