---
layout: default
title: Url
parent: Components
has_children: true
permalink: url
---



# `Centum\Url`

This component enables you to easily change your base URI across your codebase.
It centralises URI management, making it simple to update your application URLs in one place without modifying every reference manually.
This can be useful in cases where the URI might change depending on the environment (for example: development, staging, or production).

```php
Centum\Url\Url(
    string $baseUri = ""
);
```

{: .highlight }
[`Centum\Url\Url`](https://github.com/SidRoberts/centum/blob/main/src/Url/Url.php) implements [`Centum\Interfaces\Url\UrlInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Url/UrlInterface.php).

[`Centum\Url\Url`](https://github.com/SidRoberts/centum/blob/main/src/Url/Url.php) has 2 public methods:

- `getBaseUri(): string`:
  Returns the base URI that was set during construction.
- `get(string $uri = "", array $arguments = []): string`:
  Generates a full URL by appending the given URI and query arguments to the base URI.

`Centum\Url\Url` takes care of trailing and leading slashes, so you do not need to worry about double slashes or missing separators:

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
They are automatically sanitised and encoded by [`http_build_query()`](http://php.net/http_build_query), which prevents errors and ensures safe URLs:

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

Using `Centum\Url\Url` helps enforce consistent URL formatting throughout your project.
For example, all generated URLs will correctly handle slashes, query parameters, and encoding, reducing the chance of broken links or misformatted requests.
This component can take care of environment-specific logic, such as switching between HTTP and HTTPS.



## Links

- [Source code (`src/Url/`)](https://github.com/SidRoberts/centum/blob/main/src/Url/)
- [Interfaces (`src/Interfaces/Url/`)](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Url/)
- [Unit tests (`tests/Unit/Url/`)](https://github.com/SidRoberts/centum/blob/main/tests/Unit/Url/)
