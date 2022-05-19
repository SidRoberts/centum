<?php

namespace Tests\Unit\Validator;

use Centum\Validator\Slug;
use Codeception\Example;
use Tests\UnitTester;

class SlugCest
{
    /**
     * @dataProvider validSlugsProvider
     */
    public function testValidSlugs(UnitTester $I, Example $example): void
    {
        $validator = new Slug();

        $actual = $validator->validate(
            $example[0]
        );

        $I->assertEquals(
            [],
            $actual,
        );
    }

    protected function validSlugsProvider(): array
    {
        return [
            ["valid"],
            ["this-is-a-valid-slug"],
        ];
    }



    /**
     * @dataProvider invalidSlugsProvider
     */
    public function testInvalidSlugs(UnitTester $I, Example $example): void
    {
        $validator = new Slug();

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

    protected function invalidSlugsProvider(): array
    {
        return [
            ["NOT-VALID"],
            ["not_a_valid_slug"],
            ["not.a.valid-slug"],
            ["not a valid slug"],
            ["-not-valid"],
            ["not-valid-"],
        ];
    }



    public function testNonString(UnitTester $I): void
    {
        $validator = new Slug();

        $actual = $validator->validate(123);

        $I->assertEquals(
            [
                "Value is not a string.",
            ],
            $actual
        );
    }
}
