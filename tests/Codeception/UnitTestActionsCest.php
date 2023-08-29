<?php

namespace Tests\Codeception;

use Tests\Support\CodeceptionTester;

/**
 * @covers \Centum\Codeception\Actions\UnitTestActions
 */
class UnitTestActionsCest
{
    public function testGrabEchoContent(CodeceptionTester $I): void
    {
        $content = $I->grabEchoContent(
            function (): void {
                echo "h";
                echo "e";
                echo "l";
                echo "l";
                echo "o";
            }
        );

        $I->assertEquals(
            "hello",
            $content
        );
    }

    public function testExpectEcho(CodeceptionTester $I): void
    {
        $I->expectEcho(
            "hello",
            function (): void {
                echo "h";
                echo "e";
                echo "l";
                echo "l";
                echo "o";
            }
        );
    }
}
