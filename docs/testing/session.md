---
layout: default
title: Session Actions
parent: Testing
permalink: testing/session
---



# Session Actions

[`Centum\Codeception\Actions\SessionActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/SessionActions.php)

- `grabSession(): Centum\Interfaces\Http\SessionInterface`
- `seeInSession(string $key): void`
- `dontSeeInSession(string $key): void`
- `grabFromSession(string $key, mixed $defaultValue = null): mixed`
- `seeValueInSessionIs(string $key, string $expectedValue): void`
- `seeValueInSessionIsNot(string $key, string $expectedValue): void`
- `removeFromSession(string $key): void`
