<?php

namespace Tests\Codeception;

use Centum\Interfaces\Flash\FlashInterface;
use Tests\Support\CodeceptionTester;

/**
 * @covers \Centum\Codeception\Actions\FlashActions
 */
final class FlashActionsCest
{
    public function testGrabFlash(CodeceptionTester $I): void
    {
        $flashFromContainer = $I->grabFromContainer(FlashInterface::class);

        $flash = $I->grabFlash();

        $I->assertSame(
            $flashFromContainer,
            $flash
        );
    }
}
