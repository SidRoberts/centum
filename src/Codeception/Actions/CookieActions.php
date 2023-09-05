<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Http\CookiesInterface;
use Centum\Interfaces\Http\ResponseInterface;
use PHPUnit\Framework\Assert;

trait CookieActions
{
    abstract public function grabResponse(): ResponseInterface;



    /**
     * Grab the HTTP Cookies from the Container.
     */
    public function grabCookies(): CookiesInterface
    {
        $response = $this->grabResponse();

        $cookies = $response->getCookies();

        return $cookies;
    }



    /**
     * @param non-empty-string $name
     */
    public function grabCookieValue(string $name): string|null
    {
        $cookies = $this->grabCookies();

        if (!$cookies->has($name)) {
            return null;
        }

        $cookie = $cookies->get($name);

        return $cookie->getValue();
    }



    /**
     * Check that a Cookie exists.
     *
     * @param non-empty-string $name
     */
    public function seeCookie(string $name): void
    {
        $cookies = $this->grabCookies();

        Assert::assertTrue(
            $cookies->has($name),
            "Failed to see cookie."
        );
    }

    /**
     * Check that a Cookie does not exist.
     *
     * @param non-empty-string $name
     */
    public function dontSeeCookie(string $name): void
    {
        $cookies = $this->grabCookies();

        Assert::assertFalse(
            $cookies->has($name),
            "Failed to not see cookie."
        );
    }



    /**
     * @param non-empty-string $name
     */
    public function seeCookieValueIs(string $name, string $expectedValue): void
    {
        $cookieValue = $this->grabCookieValue($name);

        Assert::assertEquals(
            $expectedValue,
            $cookieValue
        );
    }

    /**
     * @param non-empty-string $name
     */
    public function dontSeeCookieValueIs(string $name, string $expectedValue): void
    {
        $cookieValue = $this->grabCookieValue($name);

        Assert::assertNotEquals(
            $expectedValue,
            $cookieValue
        );
    }
}
