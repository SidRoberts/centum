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
    Centum\Http\Method $method,
    string $uri,
    array<non-empty-string, mixed> $data = []
): Centum\Interfaces\Http\RequestInterface
```



## `sendAjaxRequest`

```php
sendAjaxRequest(
    Centum\Http\Method $method,
    string $uri,
    array<non-empty-string, mixed> $data = []
): void
```



## `sendAjaxGetRequest`

```php
sendAjaxGetRequest(
    string $uri,
    array<non-empty-string, mixed> $data = []
): void
```



## `sendAjaxPostRequest`

```php
sendAjaxPostRequest(
    string $uri,
    array<non-empty-string, mixed> $data = []
): void
```
