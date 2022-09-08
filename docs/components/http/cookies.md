---
layout: default
title: Cookies
parent: Http
grand_parent: Components
---



# Cookies

...



## Cookies Factory

You can obtain a Cookies object made with global variables using the [CookiesFactory](https://github.com/SidRoberts/centum/blob/development/src/Http/CookiesFactory.php):

```php
use Centum\Http\CookiesFactory;

$cookiesFactory = new CookiesFactory();

$cookies = $cookiesFactory->createFromGlobals();
```
