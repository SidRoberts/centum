---
layout: default
title: Cookies
parent: Http
grand_parent: Components
permalink: http/cookies
nav_order: 3
---



# Cookies

Cookies are small pieces of data stored on the client and sent with each HTTP request.
They are commonly used for session management, personalization, and tracking.

Centum provides convenient classes for working with cookies in your application.



## `Centum\Http\Cookie`

Represents a single HTTP cookie.

```php
Centum\Http\Cookie(
    string $name,
    string $value
);
```

{: .highlight }
[`Centum\Http\Cookie`](https://github.com/SidRoberts/centum/blob/development/src/Http/Cookie.php) implements [`Centum\Interfaces\Http\CookieInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/CookieInterface.php).



## `Centum\Http\Cookies`

Represents a collection of cookies.

{: .highlight }
[`Centum\Http\Cookies`](https://github.com/SidRoberts/centum/blob/development/src/Http/Cookies.php) implements [`Centum\Interfaces\Http\CookiesInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/CookiesInterface.php).



## Cookies Factory

You can obtain a Cookies object made with global variables using [`CookiesFactory`](https://github.com/SidRoberts/centum/blob/development/src/Http/CookiesFactory.php):

```php
use Centum\Http\CookiesFactory;

$cookiesFactory = new CookiesFactory();

$cookies = $cookiesFactory->createFromGlobals();

// $cookies now contains all cookies sent by the client
```
