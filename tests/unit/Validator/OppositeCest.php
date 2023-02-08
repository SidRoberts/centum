<?php

namespace Tests\Validator;

use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Validator\Opposite;
use Centum\Validator\Type\IsNull;
use Codeception\Example;
use stdClass;
use Tests\UnitTester;

class OppositeCest
{
    /**
     * @dataProvider provider
     */
    public function test(UnitTester $I, Example $example): void
    {
        $validator = new Opposite(
            new IsNull()
        );

        $actual = $validator->validate(
            $example["value"]
        );

        $I->assertEquals(
            $example["expected"],
            $actual
        );
    }

    public function provider(): array
    {
        $good = [
            new HtmlFormatter(),
            new stdClass(),
            $this,
            "just a string",
            123,
            [],
            (object) [],
            "",
            false,
        ];

        $bad = [
            null,
        ];

        $good = array_map(
            function (mixed $value): array {
                return [
                    "value"    => $value,
                    "expected" => [],
                ];
            },
            $good
        );

        $bad = array_map(
            function (mixed $value): array {
                return [
                    "value"    => $value,
                    "expected" => [
                        "not valid",
                    ],
                ];
            },
            $bad
        );

        return array_merge($good, $bad);
    }
}
