---
layout: default
title: CSRF Actions
parent: Testing
permalink: testing/csrf
---



# CSRF Actions

[`Centum\Codeception\Actions\CsrfActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/CsrfActions.php)

- `grabCsrfGenerator(): Centum\Interfaces\Http\Csrf\GeneratorInterface`
- `grabCsrfStorage(): Centum\Interfaces\Http\Csrf\StorageInterface`
- `getCsrfValue(): string`
- `resetCsrfValue(): void`
- `assumeCsrfIsValid(): void`
