<?php

namespace Tests\Unit\Http\Response;

use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Response\RedirectResponse;
use Centum\Http\Status;
use InvalidArgumentException;
use Tests\UnitTester;

class RedirectResponseCest
{
    public function testEmptyUrl(UnitTester $I)
    {
        $I->expectThrowable(
            new InvalidArgumentException("URL can't be empty."),
            function () {
                $response = new RedirectResponse("");
            }
        );
    }

    public function testMustBeARedirect(UnitTester $I)
    {
        $I->expectThrowable(
            new InvalidArgumentException("The HTTP status code must be a 3xx redirect code ('200' given)."),
            function () {
                $response = new RedirectResponse("https://github.com/sidroberts", Status::OK);
            }
        );
    }

    public function testGetter(UnitTester $I)
    {
        $response = new RedirectResponse("https://github.com/sidroberts");

        $I->assertEquals(
            "https://github.com/sidroberts",
            $response->getTargetUrl()
        );
    }

    public function testLocationHeaderIsSetWhenNoHeadersGiven(UnitTester $I)
    {
        $response = new RedirectResponse("https://github.com/sidroberts");

        $headers = $response->getHeaders()->toArray();

        $I->assertArrayHasKey("Location", $headers);

        $I->assertEquals(
            "https://github.com/sidroberts",
            $headers["Location"]
        );
    }

    public function testLocationHeaderIsSetWhenHeadersGiven(UnitTester $I)
    {
        $headers = new Headers();

        $headers->add(
            new Header("Location", "https://github.com/")
        );

        $response = new RedirectResponse("https://github.com/sidroberts", Status::FOUND, $headers);

        $headers = $response->getHeaders()->toArray();

        $I->assertArrayHasKey("Location", $headers);

        $I->assertEquals(
            "https://github.com/sidroberts",
            $headers["Location"]
        );
    }
}
