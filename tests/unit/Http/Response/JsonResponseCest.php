<?php

namespace Tests\Http\Response;

use Centum\Http\Response\JsonResponse;
use Codeception\Example;
use stdClass;
use Tests\Mvc\Filter\Doubler;
use Tests\UnitTester;

class JsonResponseCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example)
    {
        $response = new JsonResponse($example["variable"]);

        $I->assertEquals(
            $example["expected"],
            $response->getContent()
        );
    }

    public function provider(): array
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

    public function contentType(UnitTester $I)
    {
        $response = new JsonResponse(
            []
        );

        $I->assertEquals(
            "application/json",
            $response->getHeaders()->toArray()["Content-Type"]
        );
    }
}
