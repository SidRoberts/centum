---
layout: default
title: Ajax Actions
parent: Testing
permalink: testing/ajax
---



# Ajax Actions

[`Centum\Codeception\Actions\AjaxActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/AjaxActions.php)



## `createAjaxRequest`

```php
createAjaxRequest(
    string $method,
    string $uri,
    array<string, mixed> $data = []
): Centum\Interfaces\Http\RequestInterface
```



## `sendAjaxRequest`

```php
sendAjaxRequest(
    string $method,
    string $uri,
    array<string, mixed> $data = []
): void
```



## `sendAjaxGetRequest`

```php
sendAjaxGetRequest(
    string $uri,
    array<string, mixed> $data = []
): void
```



## `sendAjaxPostRequest`

```php
sendAjaxPostRequest(
    string $uri,
    array<string, mixed> $data = []
): void
```
