<?php

namespace Tests\Unit\Validator;

use Centum\Validator\CommandSlug;
use Codeception\Example;
use Tests\UnitTester;

class CommandSlugCest
{
    /**
     * @dataProvider validCommandSlugsProvider
     */
    public function testValidCommandSlugs(UnitTester $I, Example $example): void
    {
        $validator = new CommandSlug();

        $actual = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            [],
            $actual,
        );
    }

    public function validCommandSlugsProvider(): array
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
     * @dataProvider invalidCommandSlugsProvider
     */
    public function testInvalidCommandSlugs(UnitTester $I, Example $example): void
    {
        $validator = new CommandSlug();

        $actual = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            [
                "Value is not a valid slug.",
            ],
            $actual
        );
    }

    public function invalidCommandSlugsProvider(): array
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



    public function testNonString(UnitTester $I): void
    {
        $validator = new CommandSlug();

        $actual = $validator->validate(123);

        $I->assertEquals(
            [
                "Value is not a string.",
            ],
            $actual
        );
    }
}
