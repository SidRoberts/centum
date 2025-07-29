<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Validator\ValidatorInterface;
use PHPUnit\Framework\Assert;

/**
 * Validator Actions
 */
trait ValidatorActions
{
    public function seeValidatorPasses(ValidatorInterface $validator, mixed $value): void
    {
        $violations = $validator->validate($value);

        Assert::assertCount(0, $violations);
    }

    /**
     * @param list<string>|null $expectedViolations
     */
    public function seeValidatorFails(ValidatorInterface $validator, mixed $value, ?array $expectedViolations = null): void
    {
        $violations = $validator->validate($value);

        Assert::assertNotCount(0, $violations);

        if ($expectedViolations !== null) {
            Assert::assertEquals(
                $expectedViolations,
                $violations
            );
        }
    }
}
