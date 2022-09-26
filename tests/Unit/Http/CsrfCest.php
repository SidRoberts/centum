<?php

namespace Tests\Unit\Http;

use Centum\Http\Csrf;
use Centum\Http\Session;
use Centum\Http\Session\ArrayHandler;
use Centum\Interfaces\Http\SessionInterface;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Mockery;
use Mockery\MockInterface;
use Tests\Support\UnitTester;

class CsrfCest
{
    public function testGet(UnitTester $I): void
    {
        $session = Mockery::mock(
            SessionInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("get")
                    ->with(Csrf::TOKEN)
                    ->andReturn("abcdefghijklmnop");
            }
        );

        $csrf = new Csrf($session);

        $I->assertEquals(
            "abcdefghijklmnop",
            $csrf->get()
        );
    }

    public function testGetWhenNotAlreadySet(UnitTester $I): void
    {
        $session = Mockery::mock(
            SessionInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("get")
                    ->with(Csrf::TOKEN)
                    ->andReturn(null);

                $mock->shouldReceive("set")
                    ->withSomeOfArgs(Csrf::TOKEN);
            }
        );

        $csrf = new Csrf($session);

        $value = $csrf->get();

        $I->assertNotNull(
            $value
        );

        $I->assertEquals(
            Csrf::LENGTH,
            strlen($value)
        );
    }

    public function testValueIsPersistent(UnitTester $I): void
    {
        $handler = new ArrayHandler();

        $session = new Session($handler);

        $csrf = new Csrf($session);

        $I->assertEquals(
            $csrf->get(),
            $csrf->get()
        );
    }



    public function testGenerate(UnitTester $I): void
    {
        $handler = new ArrayHandler();

        $session = new Session($handler);

        $csrf = new Csrf($session);

        $value = $csrf->generate();

        $I->assertEquals(
            Csrf::LENGTH,
            strlen($value)
        );

        $I->assertRegExp(
            "/^[A-Za-z0-9]{32}$/",
            $value
        );

        $I->assertNotEquals(
            $value,
            $csrf->generate()
        );
    }

    public function testValueIsOverwrittenWhenGenerated(UnitTester $I): void
    {
        $handler = new ArrayHandler();

        $session = new Session($handler);

        $csrf = new Csrf($session);

        $value1 = $csrf->get();
        $value2 = $csrf->generate();
        $value3 = $csrf->get();

        $I->assertNotEquals(
            $value1,
            $value2
        );

        $I->assertEquals(
            $value2,
            $value3
        );
    }



    public function testReset(UnitTester $I): void
    {
        $handler = new ArrayHandler();

        $session = new Session($handler);

        $csrf = new Csrf($session);

        $value = $csrf->get();

        $csrf->reset();

        $I->assertNotEquals(
            $value,
            $csrf->get()
        );
    }



    #[DataProvider("providerValidate")]
    public function testValidate(UnitTester $I, Example $example): void
    {
        $session = Mockery::mock(
            SessionInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("get")
                    ->with(Csrf::TOKEN)
                    ->andReturn("abcdefghijklmnop");
            }
        );

        $csrf = new Csrf($session);

        /** @var bool */
        $isValid = $example["isValid"];

        /** @var string */
        $value = $example["value"];

        $I->assertEquals(
            $isValid,
            $csrf->validate($value)
        );
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
