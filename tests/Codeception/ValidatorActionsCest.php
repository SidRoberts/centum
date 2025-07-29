<?php

namespace Tests\Codeception;

use Centum\Interfaces\Validator\ValidatorInterface;
use Tests\Support\CodeceptionTester;

/**
 * @covers \Centum\Codeception\Actions\ValidatorActions
 */
final class ValidatorActionsCest
{
    public function testSeeValidatorPasses(CodeceptionTester $I): void
    {
        $validator = new class implements ValidatorInterface {
            public function validate(mixed $value): array
            {
                return [];
            }
        };

        $I->seeValidatorPasses(
            $validator,
            "anything"
        );
    }

    public function testSeeValidatorFails(CodeceptionTester $I): void
    {
        $validator = new class implements ValidatorInterface {
            public function validate(mixed $value): array
            {
                return [
                    "Nothing works.",
                ];
            }
        };

        $I->seeValidatorFails(
            $validator,
            "anything"
        );

        $I->seeValidatorFails(
            $validator,
            "anything",
            [
                "Nothing works.",
            ]
        );
    }
}
