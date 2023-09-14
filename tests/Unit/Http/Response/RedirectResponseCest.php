<?php

namespace Tests\Unit\Http\Response;

use Centum\Http\Response\RedirectResponse;
use Centum\Http\Status;
use InvalidArgumentException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Response\RedirectResponse
 */
class RedirectResponseCest
{
    public function testEmptyUrl(UnitTester $I): void
    {
        $I->expectThrowable(
            new InvalidArgumentException("URL can't be empty."),
            function (): void {
                new RedirectResponse("");
            }
        );
    }

    public function testMustBeARedirect(UnitTester $I): void
    {
        $I->expectThrowable(
            new InvalidArgumentException("The HTTP status code must be a 3xx redirect code ('200' given)."),
            function (): void {
                new RedirectResponse("https://github.com/sidroberts", Status::OK);
            }
        );
    }

    public function testGetter(UnitTester $I): void
    {
        $response = new RedirectResponse("https://github.com/sidroberts");

        $I->assertEquals(
            "https://github.com/sidroberts",
            $response->getTargetUrl()
        );
    }

    public function testLocationHeaderIsSet(UnitTester $I): void
    {
        $response = new RedirectResponse("https://github.com/sidroberts");

        $headers = $response->getHeaders()->toArray();

        $I->assertArrayHasKey("Location", $headers);

        $I->assertEquals(
            "https://github.com/sidroberts",
            $headers["Location"]
        );
    }
}
