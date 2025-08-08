---
layout: default
title: Interfaces
parent: Translation
grand_parent: Components
permalink: translation/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Translation` namespace)



## [`Centum\Interfaces\Translation\LocaleInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Translation/LocaleInterface.php)

```php
getCode(): non-empty-string
```

```php
getTranslations(): array<non-empty-string, array<non-empty-string, non-empty-string>>
```

```php
flattenKeys(): list<non-empty-string>
```



## [`Centum\Interfaces\Translation\LocalesInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Translation/LocalesInterface.php)

```php
getAvailableCodes(): list<non-empty-string>
```

```php
load(
    non-empty-string $code
): Centum\Interfaces\Translation\LocaleInterface
```



## [`Centum\Interfaces\Translation\TranslatorInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Translation/TranslatorInterface.php)

```php
translate(
    non-empty-string $domain,
    non-empty-string $key,
    array<non-empty-string, mixed> $values = []
): string
```
