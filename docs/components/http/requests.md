---
layout: default
title: Requests
parent: Http
grand_parent: Components
permalink: http/requests
nav_order: 1
---



# Requests

HTTP requests are the foundation of client-server communication.
A request contains information about the resource being accessed, the HTTP method, headers, cookies, and any data sent by the client.

Centum provides a flexible `Request` class to represent incoming HTTP requests.

```php
Centum\Http\Request(
    string $uri,
    Centum\Http\Method $method = Centum\Http\Method::GET,
    Centum\Interfaces\Http\DataInterface $data = null,
    Centum\Interfaces\Http\HeadersInterface $headers = null,
    Centum\Interfaces\Http\CookiesInterface $cookies = null,
    Centum\Interfaces\Http\FilesInterface $files = null,
    string $content = null
);
```

{: .highlight }
[`Centum\Http\Request`](https://github.com/SidRoberts/centum/blob/development/src/Http/Request.php) implements [`Centum\Interfaces\Http\RequestInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/RequestInterface.php).



## Creating a Request

You can manually create a request:

```php
use Centum\Http\Request;
use Centum\Http\Method;

$request = new Request(
    "/profile",
    Method::POST,
    // ...other parameters...
);
```



## Request Factory

You can obtain a Request object made with global variables using the [`RequestFactory`](https://github.com/SidRoberts/centum/blob/development/src/Http/RequestFactory.php):

```php
use Centum\Http\RequestFactory;

$requestFactory = new RequestFactory();

$request = $requestFactory->createFromGlobals();

// $request now represents the current HTTP request
```

Due to constraints with HTML forms (which only create GET or POST requests), the Request Factory allows the method to be overwritten using a POST field of `"_method"`.
