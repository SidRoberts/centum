<?php

namespace Tests\Unit\Validator;

use Centum\Validator\CommandSlug;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\CommandSlug
 */
final class CommandSlugCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new CommandSlug();

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
            ["slug"],
            ["valid-slug"],
            ["valid:slug"],
            ["one:two:three"],
            ["one-dash:two-dash:three-dash"],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new CommandSlug();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            [
                "Value is not a valid slug.",
            ]
        );
    }

    /**
     * @return array<array{0: string}>
     */
    protected function providerBad(): array
    {
        return [
            ["NOT-VALID"],
            ["not_a_valid_slug"],
            ["not.a.valid-slug"],
            ["not a valid slug"],
            ["-not-valid"],
            ["not-valid-"],
            ["not-valid:"],
            [":not-valid"],
        ];
    }



    #[DataProvider("providerNonString")]
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new CommandSlug();

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



    public function testEmptyValue(UnitTester $I): void
    {
        $validator = new CommandSlug();

        $I->seeValidatorPasses(
            $validator,
            ""
        );
    }
}
