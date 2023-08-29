<?php

namespace Tests\Unit\Validator\Type;

use Centum\Validator\Type\IsCharacter;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsCharacter
 */
class IsCharacterCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsCharacter();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    protected function providerGood(): array
    {
        return [
            ["S"],
            ["0"],
            ["/"],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsCharacter();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a character."]
        );
    }

    protected function providerBad(): array
    {
        return [
            ["Sid"],
            [""],
            ["123"],
        ];
    }



    #[DataProvider("providerNonString")]
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new IsCharacter();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a string."]
        );
    }

    protected function providerNonString(): array
    {
        return [
            [[1,2,3]],
            [[]],
            [true],
            [false],
            [123.456],
            [123],
            [0],
            [null],
            [new stdClass()],
        ];
    }
}
