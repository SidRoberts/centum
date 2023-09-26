<?php

namespace Tests\Codeception;

use Centum\Interfaces\Http\Csrf\GeneratorInterface;
use Centum\Interfaces\Http\Csrf\StorageInterface;
use Mockery\MockInterface;
use Tests\Support\CodeceptionTester;

/**
 * @covers \Centum\Codeception\Actions\CsrfActions
 */
final class CsrfActionsCest
{
    public function testGrabCsrfGenerator(CodeceptionTester $I): void
    {
        $generatorFromContainer = $I->grabFromContainer(GeneratorInterface::class);

        $generator = $I->grabCsrfGenerator();

        $I->assertSame(
            $generatorFromContainer,
            $generator
        );
    }

    public function testGrabCsrfStorage(CodeceptionTester $I): void
    {
        $storageFromContainer = $I->grabFromContainer(StorageInterface::class);

        $storage = $I->grabCsrfStorage();

        $I->assertSame(
            $storageFromContainer,
            $storage
        );
    }



    public function testGetCsrfValue(CodeceptionTester $I): void
    {
        $csrfStorage = $I->grabCsrfStorage();

        $I->assertSame(
            $csrfStorage->get(),
            $I->getCsrfValue()
        );
    }

    public function testResetCsrfValue(CodeceptionTester $I): void
    {
        $I->mockInContainer(
            StorageInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("reset");
            }
        );

        $I->resetCsrfValue();
    }
}
