<?php

namespace Tests\Http;

use Centum\Http\Response;
use Tests\UnitTester;

class ResponseCest
{
    public function getContent(UnitTester $I)
    {
        $response = new Response("Hello world");

        $I->assertEquals(
            "Hello world",
            $response->getContent()
        );
    }
}
