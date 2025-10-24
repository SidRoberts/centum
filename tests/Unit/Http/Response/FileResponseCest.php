<?php

namespace Tests\Unit\Http\Response;

use Centum\Http\Response\FileResponse;
use Centum\Interfaces\Http\ResponseInterface;
use Exception;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Response\FileResponse
 */
final class FileResponseCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $response = $I->mock(FileResponse::class);

        $I->assertInstanceOf(ResponseInterface::class, $response);
    }



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
