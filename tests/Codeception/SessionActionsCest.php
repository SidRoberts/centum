<?php

namespace Tests\Codeception;

use Centum\Http\Session\ArraySession;
use Centum\Interfaces\Http\SessionInterface;
use Tests\Support\CodeceptionTester;

/**
 * @covers \Centum\Codeception\Actions\SessionActions
 */
class SessionActionsCest
{
    public function testGrabSession(CodeceptionTester $I): void
    {
        $sessionFromContainer = $I->grabFromContainer(SessionInterface::class);

        $session = $I->grabSession();

        $I->assertSame(
            $sessionFromContainer,
            $session
        );
    }

    public function testSeeInSession(CodeceptionTester $I): void
    {
        $session = new ArraySession();

        $session->set("number", 123);

        $I->addToContainer(
            SessionInterface::class,
            $session
        );

        $I->seeInSession("number");
    }

    public function testDontSeeInSession(CodeceptionTester $I): void
    {
        $session = new ArraySession();

        $I->addToContainer(
            SessionInterface::class,
            $session
        );

        $I->dontSeeInSession("number");
    }

    public function testGrabFromSession(CodeceptionTester $I): void
    {
        $session = new ArraySession();

        $session->set("number", 123);

        $I->addToContainer(
            SessionInterface::class,
            $session
        );

        /** @var int */
        $value = $I->grabFromSession("number");

        $I->assertEquals(
            123,
            $value
        );
    }

    public function testSeeValueInSessionIs(CodeceptionTester $I): void
    {
        $session = new ArraySession();

        $session->set("number", 123);

        $I->addToContainer(SessionInterface::class, $session);

        $I->seeValueInSessionIs("number", 123);
    }

    public function testSeeValueInSessionIsNot(CodeceptionTester $I): void
    {
        $session = new ArraySession();

        $session->set("number", 123);

        $I->addToContainer(SessionInterface::class, $session);

        $I->seeValueInSessionIsNot("number", 456);
    }

    public function testRemoveFromSession(CodeceptionTester $I): void
    {
        $session = new ArraySession();

        $session->set("number", 123);

        $I->addToContainer(
            SessionInterface::class,
            $session
        );

        $I->removeFromSession("number");

        $I->dontSeeInSession("number");
    }
}
