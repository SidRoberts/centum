---
layout: default
title: Headers
parent: Http
grand_parent: Components
permalink: http/headers
nav_order: 4
---



# Headers

...

```php
Centum\Http\Header(
    string $name,
    string $value
);
```

{: .highlight }
[`Centum\Http\Header`](https://github.com/SidRoberts/centum/blob/development/src/Http/Header.php) implements [`Centum\Interfaces\Http\HeaderInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/HeaderInterface.php).

{: .highlight }
[`Centum\Http\Headers`](https://github.com/SidRoberts/centum/blob/development/src/Http/Headers.php) implements [`Centum\Interfaces\Http\HeadersInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/HeadersInterface.php).



## Headers Factory

You can obtain a Headers object made with global variables using the [HeadersFactory](https://github.com/SidRoberts/centum/blob/development/src/Http/HeadersFactory.php):

```php
use Centum\Http\HeadersFactory;

$headersFactory = new HeadersFactory();

$headers = $headersFactory->createFromGlobals();
```
