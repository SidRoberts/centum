<?php

namespace Tests\Unit\Validator\Type;

use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Interfaces\Validator\ValidatorInterface;
use Centum\Validator\Type\IsResource;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use RuntimeException;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Validator\Type\IsResource
 */
final class IsResourceCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $validator = $I->mock(IsResource::class);

        $I->assertInstanceOf(ValidatorInterface::class, $validator);
    }



    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $validator = new IsResource();

        $I->seeValidatorPasses(
            $validator,
            $example[0]
        );
    }

    /**
     * @return array<array{0: resource}>
     */
    protected function providerGood(): array
    {
        $resource = fopen("php://memory", "r+");

        if ($resource === false) {
            throw new RuntimeException("Unable to make a resource.");
        }

        return [
            [$resource],
        ];
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        $validator = new IsResource();

        $I->seeValidatorFails(
            $validator,
            $example[0],
            ["Value is not a resource."]
        );
    }

    /**
     * @return array<array{0: mixed}>
     */
    protected function providerBad(): array
    {
        return [
            [true],
            [false],
            [123.456],
            [123],
            [0],
            [null],
            [new HtmlFormatter()],
            [(object) []],
            [$this],
            [new stdClass()],
            ["Sid Roberts"],
            [""],
        ];
    }
}
