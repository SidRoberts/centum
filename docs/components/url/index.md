---
layout: default
title: Url
parent: Components
has_children: true
permalink: url
---



# `Centum\Url`

This component takes care of trailing/leading slashes and enables you to easily change your base URI depending on the environment (for example: development and production).

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
