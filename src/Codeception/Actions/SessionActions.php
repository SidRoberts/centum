<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\SessionInterface;
use PHPUnit\Framework\Assert;

trait SessionActions
{
    abstract public function grabContainer(): ContainerInterface;



    public function grabSession(): SessionInterface
    {
        $container = $this->grabContainer();

        $session = $container->get(SessionInterface::class);

        return $session;
    }



    public function seeInSession(string $key): void
    {
        $session = $this->grabSession();

        Assert::assertTrue(
            $session->has($key)
        );
    }

    public function dontSeeInSession(string $key): void
    {
        $session = $this->grabSession();

        Assert::assertFalse(
            $session->has($key)
        );
    }



    public function grabFromSession(string $key, mixed $defaultValue = null): mixed
    {
        $session = $this->grabSession();

        return $session->get($key, $defaultValue);
    }



    public function seeValueInSessionIs(string $key, mixed $expectedValue): void
    {
        /** @var mixed */
        $actualValue = $this->grabFromSession($key);

        Assert::assertEquals(
            $expectedValue,
            $actualValue
        );
    }

    public function seeValueInSessionIsNot(string $key, mixed $expectedValue): void
    {
        /** @var mixed */
        $actualValue = $this->grabFromSession($key);

        Assert::assertNotEquals(
            $expectedValue,
            $actualValue
        );
    }



    public function removeFromSession(string $key): void
    {
        $session = $this->grabSession();

        $session->remove($key);
    }
}
