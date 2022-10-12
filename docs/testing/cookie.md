---
layout: default
title: Cookie Actions
parent: Testing
permalink: testing/cookie
---



# Cookie Actions

[`Centum\Codeception\Actions\CookieActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/CookieActions.php)

- `grabCookies(): Centum\Interfaces\Http\CookiesInterface`
- `grabCookieValue(string $name): void`
- `seeCookie(string $name): void`
- `dontSeeCookie(string $name): void`
- `seeCookieValueIs(string $name, string $value): void`
- `dontSeeCookieValueIs(string $name, string $value): void`