<?php

namespace Tests\Unit\Http\Response;

use Centum\Http\Response\JsonResponse;
use Centum\Http\Status;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class JsonResponseCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $response = new JsonResponse($example["variable"]);

        $I->assertEquals(
            $example["expected"],
            $response->getContent()
        );
    }

    protected function provider(): array
    {
        $object = new stdClass();

        $object->a = [];
        $object->b = true;

        return [
            [
                "variable" => "Hello Sid",
                "expected" => "\"Hello Sid\"",
            ],

            [
                "variable" => 0,
                "expected" => "0",
            ],

            [
                "variable" => true,
                "expected" => "true",
            ],

            [
                "variable" => [1,"a"],
                "expected" => "[" . PHP_EOL . "    1," . PHP_EOL . "    \"a\"" . PHP_EOL . "]",
            ],

            [
                "variable" => new stdClass(),
                "expected" => "{}",
            ],

            [
                "variable" => $object,
                "expected" => "{" . PHP_EOL . "    \"a\": []," . PHP_EOL . "    \"b\": true" . PHP_EOL . "}",
            ],
        ];
    }

    public function testContentType(UnitTester $I): void
    {
        $response = new JsonResponse(
            []
        );

        $I->assertEquals(
            "application/json",
            $response->getHeaders()->toArray()["Content-Type"]
        );
    }

    public function testStatus(UnitTester $I): void
    {
        $response = new JsonResponse(
            []
        );

        $I->assertSame(
            Status::OK,
            $response->getStatus()
        );
    }

    public function testCustomStatus(UnitTester $I): void
    {
        $response = new JsonResponse(
            [],
            Status::INTERNAL_SERVER_ERROR
        );

        $I->assertSame(
            Status::INTERNAL_SERVER_ERROR,
            $response->getStatus()
        );
    }
}
