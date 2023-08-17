---
layout: default
title: Cookies
parent: Http
grand_parent: Components
permalink: http/cookies
nav_order: 3
---



# Cookies

...

```php
Centum\Http\Cookie(
    string $name,
    string $value
);
```

{: .highlight }
[`Centum\Http\Cookie`](https://github.com/SidRoberts/centum/blob/development/src/Http/Cookie.php) implements [`Centum\Interfaces\Http\CookieInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/CookieInterface.php).

{: .highlight }
[`Centum\Http\Cookies`](https://github.com/SidRoberts/centum/blob/development/src/Http/Cookies.php) implements [`Centum\Interfaces\Http\CookiesInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/CookiesInterface.php).



## Cookies Factory

You can obtain a Cookies object made with global variables using the [CookiesFactory](https://github.com/SidRoberts/centum/blob/development/src/Http/CookiesFactory.php):

```php
use Centum\Http\CookiesFactory;

$cookiesFactory = new CookiesFactory();

$cookies = $cookiesFactory->createFromGlobals();
```
