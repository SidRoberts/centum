<?php

namespace Tests\Support\Controllers;

use Centum\Http\Cookie;
use Centum\Http\Cookies;
use Centum\Http\Response;
use Centum\Http\Status;
use Centum\Interfaces\Http\CookieInterface;
use Centum\Interfaces\Http\CookiesInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

final class CookiesController implements ControllerInterface
{
    public function index(): ResponseInterface
    {
        $cookies = new Cookies(
            [
                new Cookie("username", "SidRoberts"),
            ]
        );

        return new Response(
            "content",
            Status::OK,
            null,
            $cookies
        );
    }



    public function resolverCookies(CookiesInterface $cookies): ResponseInterface
    {
        return new Response(
            serialize($cookies)
        );
    }

    public function resolverCookie(CookieInterface $username): ResponseInterface
    {
        return new Response(
            $username->getValue()
        );
    }

    public function resolverCookieOptional(?CookieInterface $username): ResponseInterface
    {
        if (!$username) {
            return new Response(
                "username not set."
            );
        }

        return new Response(
            $username->getValue()
        );
    }
}
