<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Http\CookiesInterface;
use Centum\Interfaces\Http\ResponseInterface;
use PHPUnit\Framework\Assert;

trait CookieActions
{
    abstract public function grabResponse(): ResponseInterface;



    public function grabCookies(): CookiesInterface
    {
        $response = $this->grabResponse();

        $cookies = $response->getCookies();

        return $cookies;
    }



    public function grabCookieValue(string $name): string|null
    {
        $response = $this->grabResponse();

        $cookies = $response->getCookies();

        if (!$cookies->has($name)) {
            return null;
        }

        $cookie = $cookies->get($name);

        return $cookie->getValue();
    }



    public function seeCookie(string $name): void
    {
        $response = $this->grabResponse();

        $cookies = $response->getCookies();

        Assert::assertTrue(
            $cookies->has($name),
            "Failed to see cookie."
        );
    }

    public function dontSeeCookie(string $name): void
    {
        $response = $this->grabResponse();

        $cookies = $response->getCookies();

        Assert::assertFalse(
            $cookies->has($name),
            "Failed to not see cookie."
        );
    }



    public function seeCookieValueIs(string $name, string $value = null): void
    {
        $cookieValue = $this->grabCookieValue($name);

        Assert::assertEquals(
            $value,
            $cookieValue
        );
    }

    public function dontSeeCookieValueIs(string $name, string $value = null): void
    {
        $cookieValue = $this->grabCookieValue($name);

        Assert::assertNotEquals(
            $value,
            $cookieValue
        );
    }
}
