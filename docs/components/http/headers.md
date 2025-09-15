---
layout: default
title: Headers
parent: Http
grand_parent: Components
permalink: http/headers
nav_order: 4
---



# Headers

HTTP headers are key-value pairs sent with requests and responses.
Centum provides classes to represent and manage headers in a type-safe way.



## `Centum\Http\Header`

Represents a single HTTP header.

```php
Centum\Http\Header(
    string $name,
    string $value
);
```

- `$name`: The header name (e.g., `"Content-Type"`).
- `$value`: The header value (e.g., `"application/json"`).

{: .highlight }
[`Centum\Http\Header`](https://github.com/SidRoberts/centum/blob/main/src/Http/Header.php) implements [`Centum\Interfaces\Http\HeaderInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/HeaderInterface.php).



## `Centum\Http\Headers`

Represents a collection of HTTP headers.

{: .highlight }
[`Centum\Http\Headers`](https://github.com/SidRoberts/centum/blob/main/src/Http/Headers.php) implements [`Centum\Interfaces\Http\HeadersInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/HeadersInterface.php).

### Example

```php
use Centum\Http\Header;
use Centum\Http\Headers;

$headers = new Headers(
    [
        new Header("Content-Type", "application/json"),
        new Header("Cache-Control", "no-cache"),
    ]
);
```



## Headers Factory

You can obtain a Headers object populated from global variables using [`HeadersFactory`](https://github.com/SidRoberts/centum/blob/main/src/Http/HeadersFactory.php):

```php
use Centum\Http\HeadersFactory;

$headersFactory = new HeadersFactory();

$headers = $headersFactory->createFromGlobals();
```
