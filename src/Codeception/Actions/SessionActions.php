<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Http\SessionInterface;
use PHPUnit\Framework\Assert;

/**
 * Session Actions
 */
trait SessionActions
{
    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
     */
    abstract public function grabFromContainer(string $class): object;



    /**
     * Grab the HTTP Session from the Container.
     */
    public function grabSession(): SessionInterface
    {
        return $this->grabFromContainer(SessionInterface::class);
    }



    /**
     * Check that a Session key exists.
     *
     * @param non-empty-string $key
     */
    public function seeInSession(string $key): void
    {
        $session = $this->grabSession();

        Assert::assertTrue(
            $session->has($key)
        );
    }

    /**
     * Check that a Session key does not exist.
     *
     * @param non-empty-string $key
     */
    public function dontSeeInSession(string $key): void
    {
        $session = $this->grabSession();

        Assert::assertFalse(
            $session->has($key)
        );
    }



    /**
     * @param non-empty-string $key
     */
    public function grabFromSession(string $key, mixed $defaultValue = null): mixed
    {
        $session = $this->grabSession();

        return $session->get($key, $defaultValue);
    }



    /**
     * @param non-empty-string $key
     */
    public function seeValueInSessionIs(string $key, mixed $expectedValue): void
    {
        /** @var mixed */
        $actualValue = $this->grabFromSession($key);

        Assert::assertEquals(
            $expectedValue,
            $actualValue
        );
    }

    /**
     * @param non-empty-string $key
     */
    public function seeValueInSessionIsNot(string $key, mixed $expectedValue): void
    {
        /** @var mixed */
        $actualValue = $this->grabFromSession($key);

        Assert::assertNotEquals(
            $expectedValue,
            $actualValue
        );
    }



    /**
     * Remove a key from the Session.
     *
     * @param non-empty-string $key
     */
    public function removeFromSession(string $key): void
    {
        $session = $this->grabSession();

        $session->remove($key);
    }
}
