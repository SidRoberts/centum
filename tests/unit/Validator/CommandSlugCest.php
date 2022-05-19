<?php

namespace Tests\Unit\Validator;

use Centum\Validator\CommandSlug;
use Codeception\Example;
use Tests\UnitTester;

class CommandSlugCest
{
    /**
     * @dataProvider providerGood
     */
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new CommandSlug();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertCount(0, $violations);
    }

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



    /**
     * @dataProvider providerBad
     */
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new CommandSlug();

        $violations = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            [
                "Value is not a valid slug.",
            ],
            $violations
        );
    }

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



    /**
     * @dataProvider providerNonString
     */
    public function testNonString(UnitTester $I, Example $example): void
    {
        $validator = new CommandSlug();

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
