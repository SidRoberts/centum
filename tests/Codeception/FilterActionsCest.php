<?php

namespace Tests\Codeception;

use Centum\Filter\String\ToUpper;
use Tests\Support\CodeceptionTester;

/**
 * @covers \Centum\Codeception\Actions\FilterActions
 */
class FilterActionsCest
{
    public function testExpectFilterOutput(CodeceptionTester $I): void
    {
        $filter = new ToUpper();

        $I->expectFilterOutput(
            $filter,
            "This is an example sentence.",
            "THIS IS AN EXAMPLE SENTENCE."
        );
    }

    public function testExpectFilterException(CodeceptionTester $I): void
    {
        $I->markTestIncomplete();
    }
}
