<?php

namespace Tests\Codeception;

use Centum\Interfaces\Http\CsrfInterface;
use Tests\Support\CodeceptionTester;

class CsrfActionsCest
{
    public function testGrabCsrf(CodeceptionTester $I): void
    {
        $csrf = $I->grabFromContainer(CsrfInterface::class);

        $I->assertSame(
            $csrf,
            $I->grabCsrf()
        );
    }

    public function testGetCsrfValue(CodeceptionTester $I): void
    {
        $csrf = $I->grabFromContainer(CsrfInterface::class);

        $I->assertSame(
            $csrf->get(),
            $I->getCsrfValue()
        );
    }
}
