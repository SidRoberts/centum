<?php

namespace Tests\Unit\Http\Response;

use Centum\Http\Response\FileResponse;
use Exception;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Response\FileResponse
 */
class FileResponseCest
{
    public function test(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testUnreadableFile(UnitTester $I): void
    {
        $I->expectThrowable(
            new Exception("Unable to read file."),
            function (): void {
                new FileResponse("/a/file/that/doesnt/exist.jpg", "not-a-real-file.jpg");
            }
        );
    }
}
