<?php

namespace Tests\Unit\Validator;

use Centum\Validator\Alpha;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class AlphaCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new Alpha();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

    protected function providerGood(): array
    {
        return [
            ["SidRoberts"],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new Alpha();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value must only contain letters."],
            $violations
        );
    }

    protected function providerBad(): array
    {
        return [
            ["SidRoberts92"],
            ["##not.alphanumeric##"],
            ["This is a sentence."],
            ["이것은 영숫자가 아닙니다."],
        ];
    }



    #[DataProvider("providerNonString")]
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new Alpha();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            ["Value is not a string."],
            $violations
        );
    }

    protected function providerNonString(): array
    {
        return [
            [123],
        ];
    }
}
