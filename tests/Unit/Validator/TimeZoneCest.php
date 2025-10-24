<?php

namespace Tests\Unit\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;
use Centum\Validator\TimeZone;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\TimeZone
 */
final class TimeZoneCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $validator = $I->mock(TimeZone::class);

        $I->assertInstanceOf(ValidatorInterface::class, $validator);
    }



    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new TimeZone();

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
            ["Asia/Seoul"],
            ["UTC"],
            ["Europe/London"],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new TimeZone();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a valid time zone."]
        );
    }

    /**
     * @return array<array{0: string}>
     */
    protected function providerBad(): array
    {
        return [
            ["SidRoberts92"],
            ["NotReal/TimeZone"],
            ["This is a sentence."],
            ["이것은 영숫자가 아닙니다."],
        ];
    }



    #[DataProvider("providerNonString")]
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new TimeZone();

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
