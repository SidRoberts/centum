---
layout: default
title: Interfaces
parent: Translation Component
permalink: translation/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Translation` namespace)



## [`LocaleInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Translation/LocaleInterface.php)

```php
getCode(): non-empty-string
```

```php
getTranslations(): array<non-empty-string, array<non-empty-string, non-empty-string>>
```

```php
flattenKeys(): list<non-empty-string>
```



## [`LocalesInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Translation/LocalesInterface.php)

```php
getAvailableCodes(): list<non-empty-string>
```

```php
load(
    non-empty-string $code
): Centum\Interfaces\Translation\LocaleInterface
```



## [`TranslatorInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Translation/TranslatorInterface.php)

```php
translate(
    non-empty-string $domain,
    non-empty-string $key,
    array<non-empty-string, mixed> $values = []
): string
```
