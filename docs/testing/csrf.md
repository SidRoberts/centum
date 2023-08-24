---
layout: default
title: CSRF Actions
parent: Testing
permalink: testing/csrf
---



# CSRF Actions

[`Centum\Codeception\Actions\CsrfActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/CsrfActions.php)



## `grabCsrfGenerator`

Grab the CSRF Generator from the Container.

```php
grabCsrfGenerator(): Centum\Interfaces\Http\Csrf\GeneratorInterface
```



## `grabCsrfStorage`

Grab the CSRF Storage from the Container.

```php
grabCsrfStorage(): Centum\Interfaces\Http\Csrf\StorageInterface
```



## `getCsrfValue`

```php
getCsrfValue(): string
```



## `resetCsrfValue`

```php
resetCsrfValue(): void
```



## `assumeCsrfIsValid`

Replace the CSRF Validator with a mock that simply returns `true` for
everything.

```php
assumeCsrfIsValid(): void
```
