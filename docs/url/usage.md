---
layout: default
title: Usage
parent: Url
---



This component takes care of trailing and leading slashes.

```php
use Centum\Url\Url;

$baseUri = "https://example.com";

$url = new Url($baseUri);

// https://example.com/path/to/something
echo $url->get("path/to/something");

// https://example.com/path/to/something
echo $url->get("/path/to/something");
```

You can now easily change your base URI depending on the environment (for example: development and production).

You can also specify URL arguments which are automatically sanitised and encoded by [`http_build_query()`](http://php.net/http_build_query):

```php
// https://example.com/path/to/something?title=hello+world&page=123
echo $url->get(
    "/path/to/something",
    [
        "title" => "hello world",
        "page"  => 123,
    ]
);
```
