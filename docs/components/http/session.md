---
layout: default
title: Session
parent: Http
grand_parent: Components
permalink: http/session
nav_order: 2
---



# Session

Session classes are used to persist data for individual users, such as login details or site preferences.

{: .highlight }
All session classes implement [`Centum\Interfaces\Http\SessionInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/SessionInterface.php).

[`SessionInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/SessionInterface.php) has 8 public methods:

- `start(): bool`
- `isActive(): bool`
- `has(string $name): bool`
- `get(string $name, mixed $defaultValue = null): mixed`
- `set(string $name, mixed $value): void`
- `remove(string $name): void`
- `clear(): void`
- `all(): array`



## Available Validators

- [`Centum\Interfaces\Http\Session\ArraySession`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/Session/ArraySession.php)
- [`Centum\Interfaces\Http\Session\GlobalSession`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/Session/GlobalSession.php)
