---
layout: default
title: Responses
parent: Http Component
permalink: http/responses
nav_order: 8
---



# Responses

## [`Centum\Http\Response`](https://github.com/SidRoberts/centum/tree/development/src/Http/Response.php)

`Response` is the base Response class and can be used to display any Response to the user.

```php
Centum\Http\Response(
    string $content,
    Centum\Http\Status $status = Centum\Http\Status::OK,
    Centum\Interfaces\Http\HeadersInterface $headers = null,
    Centum\Interfaces\Http\CookiesInterface $cookies = null
);
```

{: .callout.info }
[`Centum\Http\Response`](https://github.com/SidRoberts/centum/blob/main/src/Http/Response.php) implements [`Centum\Interfaces\Http\ResponseInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/ResponseInterface.php).



## [`Centum\Http\Response\FileResponse`](https://github.com/SidRoberts/centum/tree/development/src/Http/Response/FileResponse.php)

`FileResponse` prompts a browser to download a file.
A custom filename can be set with the `$fileName` argument.

```php
Centum\Http\Response\FileResponse(
    string $filePath,
    string $fileName
);
```



## [`Centum\Http\Response\HtmlResponse`](https://github.com/SidRoberts/centum/tree/development/src/Http/Response/HtmlResponse.php)

`HtmlResponse` is suitable for HTML content.
It automatically add the correct HTTP Content-Type header (`Content-Type: text/html; charset=UTF-8`).

```php
Centum\Http\Response\HtmlResponse(
    string $content,
    Centum\Http\Status $status = Centum\Http\Status::OK,
    ?Centum\Interfaces\Http\HeadersInterface $headers = null,
    ?Centum\Interfaces\Http\CookiesInterface $cookies = null
);
```



## [`Centum\Http\Response\JsonResponse`](https://github.com/SidRoberts/centum/tree/development/src/Http/Response/JsonResponse.php)

`JsonResponse` encodes a variable into a JSON object and pretty prints it.
It automatically add the correct HTTP Content-Type header (`Content-Type: application/json`).

```php
Centum\Http\Response\JsonResponse(
    mixed $variable,
    Centum\Http\Status $status = Centum\Http\Status::OK,
    ?Centum\Interfaces\Http\HeadersInterface $headers = null,
    ?Centum\Interfaces\Http\CookiesInterface $cookies = null
);
```



## [`Centum\Http\Response\RedirectResponse`](https://github.com/SidRoberts/centum/tree/development/src/Http/Response/RedirectResponse.php)

`RedirectResponse` will set the correct headers to tell the HTTP client to redirect to another page.
If for some reason, the HTTP client doesn't obey the redirect, a HTML response is also sent that displays a link to the URL.

```php
Centum\Http\Response\RedirectResponse(
    string $url,
    Centum\Http\Status $status = Centum\Http\Status::FOUND
);
```



## [`Centum\Http\Response\VariableResponse`](https://github.com/SidRoberts/centum/tree/development/src/Http/Response/VariableResponse.php)

`VariableResponse` can be used in development to display a variable.

```php
Centum\Http\Response\VariableResponse(
    mixed $variable
);
```
