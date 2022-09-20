---
layout: default
title: Requests
parent: Http
grand_parent: Components
permalink: http/requests
nav_order: 1
---



# Requests

```php
Centum\Http\Request(
    string $uri,
    string $method = "GET",
    Centum\Http\Data $data = null,
    Centum\Http\Headers $headers = null,
    Centum\Http\Cookies $cookies = null,
    Centum\Http\Files $files = null,
    string $content = null
);
```

...



## Request Factory

You can obtain a Request object made with global variables using the [`RequestFactory`](https://github.com/SidRoberts/centum/blob/development/src/Http/RequestFactory.php):

```php
use Centum\Http\RequestFactory;

$requestFactory = new RequestFactory();

$request = $requestFactory->createFromGlobals();
```

Due to constraints with HTML forms (which only create GET or POST requests), the Request Factory allows the method to be overwritten using a POST field of `"_method"`.
