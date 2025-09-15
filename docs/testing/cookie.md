---
layout: default
title: Cookie Actions
parent: Testing
permalink: testing/cookie
---



# Cookie Actions

[`Centum\Codeception\Actions\CookieActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/CookieActions.php)



## `grabCookies`

Grab the HTTP Cookies from the Container.

```php
grabCookies(): Centum\Interfaces\Http\CookiesInterface
```



## `grabCookieValue`

```php
grabCookieValue(
    non-empty-string $name
): ?string
```



## `seeCookie`

Check that a Cookie exists.

```php
seeCookie(
    non-empty-string $name
): void
```



## `dontSeeCookie`

Check that a Cookie does not exist.

```php
dontSeeCookie(
    non-empty-string $name
): void
```



## `seeCookieValueIs`

```php
seeCookieValueIs(
    non-empty-string $name,
    string $expectedValue
): void
```



## `dontSeeCookieValueIs`

```php
dontSeeCookieValueIs(
    non-empty-string $name,
    string $expectedValue
): void
```
