---
layout: default
title: Url
parent: Components
has_children: true
permalink: url
---



# `Centum\Url`

This component enables you to easily change your base URI across your codebase.
This can be useful in cases where the URI might change depending on the environment (for example: development and production).

```php
Centum\Url\Url(
    string $baseUri = ""
);
```

{: .highlight }
[`Centum\Url\Url`](https://github.com/SidRoberts/centum/blob/development/src/Url/Url.php) implements [`Centum\Interfaces\Url\UrlInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Url/UrlInterface.php).

[`Centum\Url\Url`](https://github.com/SidRoberts/centum/blob/development/src/Url/Url.php) has 2 public methods:

- `public function getBaseUri(): string`
- `public function get(string $uri = "", array $arguments = []): string`

`Centum\Url\Url` takes care of trailing/leading slashes:

```php
use Centum\Url\Url;

$baseUri = "https://example.com";

$url = new Url($baseUri);

// https://example.com/path/to/something
echo $url->get("path/to/something");

// https://example.com/path/to/something
echo $url->get("/path/to/something");
```

You can also specify URL arguments.
They are automatically sanitised and encoded by [`http_build_query()`](http://php.net/http_build_query):

```php
// https://example.com/search?query=hello+world&page=123
echo $url->get(
    "/search",
    [
        "query" => "hello world",
        "page"  => 123,
    ]
);
```
