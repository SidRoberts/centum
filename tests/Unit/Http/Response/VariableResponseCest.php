<?php

namespace Tests\Unit\Http\Response;

use Centum\Http\Response\VariableResponse;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\Filters\Doubler;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Response\VariableResponse
 */
final class VariableResponseCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $response = new VariableResponse($example["variable"]);

        /** @var string */
        $expected = $example["expected"];

        $I->assertEquals(
            $expected,
            $response->getContent()
        );
    }

    /**
     * @return array<array{variable: mixed, expected: string}>
     */
    protected function provider(): array
    {
        return [
            [
                "variable" => "Hello Sid",
                "expected" => "'Hello Sid'",
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
                "variable" => [1, "a"],
                "expected" => "array (" . PHP_EOL . "  0 => 1," . PHP_EOL . "  1 => 'a'," . PHP_EOL . ")",
            ],

            [
                "variable" => new stdClass(),
                "expected" => "(object) array(" . PHP_EOL . ")",
            ],

            [
                "variable" => new Doubler(),
                "expected" => "\\" . Doubler::class . "::__set_state(array(" . PHP_EOL . "))",
            ],
        ];
    }

    public function testContentType(UnitTester $I): void
    {
        $response = new VariableResponse(
            []
        );

        $I->assertEquals(
            "text/plain",
            $response->getHeaders()->get("Content-Type")->getValue()
        );
    }
}
