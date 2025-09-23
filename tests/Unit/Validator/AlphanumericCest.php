<?php

namespace Tests\Unit\Validator;

use Centum\Validator\Alphanumeric;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Alphanumeric
 */
final class AlphanumericCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new Alphanumeric();

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
            ["SidRoberts92"],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new Alphanumeric();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not alphanumeric."]
        );
    }

    /**
     * @return array<array{0: string}>
     */
    protected function providerBad(): array
    {
        return [
            ["##not.alphanumeric##"],
            ["This is a sentence."],
            ["이것은 영숫자가 아닙니다."],
        ];
    }



    #[DataProvider("providerNonString")]
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new Alphanumeric();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a string."]
        );
    }

    /**
     * @return array<array{0: mixed}>
     */
    protected function providerNonString(): array
    {
        return [
            [123],
        ];
    }
}
