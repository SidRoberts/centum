<?php

namespace Tests\Unit\Http\Response;

use Centum\Http\Response\VariableResponse;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Composer\Semver\Semver;
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
        if (isset($example["version"])) {
            /** @var string */
            $version = $example["version"];

            if (!Semver::satisfies(PHP_VERSION, $version)) {
                $I->markTestSkipped();
            }
        }

        $response = new VariableResponse($example["variable"]);

        /** @var string */
        $expected = $example["expected"];

        $I->assertEquals(
            $expected,
            $response->getContent()
        );
    }

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
                "variable" => [1,"a"],
                "expected" => "array (" . PHP_EOL . "  0 => 1," . PHP_EOL . "  1 => 'a'," . PHP_EOL . ")",
            ],

            [
                "variable" => new stdClass(),
                "expected" => "(object) array(" . PHP_EOL . ")",
            ],

            [
                "variable" => new Doubler(),
                "expected" => Doubler::class . "::__set_state(array(" . PHP_EOL . "))",
                "version"  => "< 8.2",
            ],

            [
                "variable" => new Doubler(),
                "expected" => "\\" . Doubler::class . "::__set_state(array(" . PHP_EOL . "))",
                "version"  => ">= 8.2",
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
            $response->getHeaders()->toArray()["Content-Type"]
        );
    }
}
