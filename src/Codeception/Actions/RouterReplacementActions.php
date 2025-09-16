<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Router\ReplacementInterface;
use PHPUnit\Framework\Assert;

/**
 * Router Replacement Actions
 */
trait RouterReplacementActions
{
    public function assertRouterReplacementMatches(ReplacementInterface $replacement, string $value): void
    {
        $regularExpression = "#^" . $replacement->getRegularExpression() . "$#";

        Assert::assertMatchesRegularExpression($regularExpression, $value);
    }

    public function assertRouterReplacementDoesNotMatch(ReplacementInterface $replacement, string $value): void
    {
        $regularExpression = "#^" . $replacement->getRegularExpression() . "$#";

        Assert::assertDoesNotMatchRegularExpression($regularExpression, $value);
    }



    public function assertRouterReplacementEquals(ReplacementInterface $replacement, string $input, mixed $expectedOutput): void
    {
        /** @var mixed */
        $output = $replacement->process($input);

        Assert::assertEquals($expectedOutput, $output);
    }

    public function assertRouterReplacementDoesNotEqual(ReplacementInterface $replacement, string $input, mixed $expectedOutput): void
    {
        /** @var mixed */
        $output = $replacement->process($input);

        Assert::assertNotEquals($expectedOutput, $output);
    }
}
