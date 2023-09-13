<?php

namespace Tests\Unit\Http\Csrf;

use Centum\Http\Csrf\Validator;
use Centum\Http\Exception\CsrfException;
use Centum\Interfaces\Http\Csrf\StorageInterface;
use Centum\Interfaces\Http\DataInterface;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Mockery\MockInterface;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Csrf\Validator
 */
class ValidatorCest
{
    #[DataProvider("providerValidate")]
    public function testValidate(UnitTester $I, Example $example): void
    {
        $abc = "abcdefghijklmnop";

        /** @var string */
        $value = $example["value"];

        $data = $I->mock(
            DataInterface::class,
            function (MockInterface $mock) use ($value): void {
                $mock->shouldReceive("has")
                    ->with("csrf")
                    ->andReturn(true);

                $mock->shouldReceive("get")
                    ->with("csrf")
                    ->andReturn($value);
            }
        );

        $storage = $I->mock(
            StorageInterface::class,
            function (MockInterface $mock) use ($abc): void {
                $mock->shouldReceive("get")
                    ->andReturn($abc);
            }
        );

        $validator = new Validator($data, $storage);

        /** @var bool */
        $isValid = $example["isValid"];

        if ($isValid) {
            $validator->validate();
        } else {
            $I->expectThrowable(
                CsrfException::class,
                function () use ($validator): void {
                    $validator->validate();
                }
            );
        }
    }

    protected function providerValidate(): array
    {
        return [
            [
                "isValid" => true,
                "value"   => "abcdefghijklmnop",
            ],

            [
                "isValid" => false,
                "value"   => "ABCDEFGHIJKLMNOP",
            ],

            [
                "isValid" => false,
                "value"   => "1234567890123456",
            ],
        ];
    }
}
