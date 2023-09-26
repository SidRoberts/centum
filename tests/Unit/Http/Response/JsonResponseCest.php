<?php

namespace Tests\Unit\Http\Response;

use Centum\Http\Response\JsonResponse;
use Centum\Http\Status;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Response\JsonResponse
 */
final class JsonResponseCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $response = new JsonResponse($example["variable"]);

        /** @var string */
        $expected = $example["expected"];

        $I->assertEquals(
            $expected,
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
        $status = Status::INTERNAL_SERVER_ERROR;

        $response = new JsonResponse(
            [],
            $status
        );

        $I->assertSame(
            $status,
            $response->getStatus()
        );
    }
}
