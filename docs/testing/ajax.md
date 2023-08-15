---
layout: default
title: Ajax Actions
parent: Testing
permalink: testing/ajax
---



# Ajax Actions

[`Centum\Codeception\Actions\AjaxActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/AjaxActions.php)

- `createAjaxRequest(string $method, string $uri, array $data = []): Centum\Interfaces\Http\RequestInterface`
- `sendAjaxRequest(string $method, string $uri, array $data = []): void`
- `sendAjaxGetRequest(string $uri, array $data = []): void`
- `sendAjaxPostRequest(string $uri, array $data = []): void`
