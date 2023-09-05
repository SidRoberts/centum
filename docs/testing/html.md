---
layout: default
title: HTML Actions
parent: Testing
permalink: testing/html
---



# HTML Actions

[`Centum\Codeception\Actions\HtmlActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/HtmlActions.php)



## `grabTextContent`

```php
grabTextContent(): string
```



## `submitForm`

```php
submitForm(
    string $selector,
    array<non-empty-string, mixed> $data = [],
    Centum\Interfaces\Http\FilesInterface $files = null
): void
```



## `see`

```php
see(
    non-empty-string $needle
): void
```



## `dontSee`

```php
dontSee(
    non-empty-string $needle
): void
```



## `seeInSource`

```php
seeInSource(
    non-empty-string $needle
): void
```



## `dontSeeInSource`

```php
dontSeeInSource(
    non-empty-string $needle
): void
```



## `seeInPageTitle`

```php
seeInPageTitle(
    non-empty-string $needle
): void
```



## `dontSeeInPageTitle`

```php
dontSeeInPageTitle(
    non-empty-string $needle
): void
```



## `grabPageTitle`

Grabs the page title from the `<title>` tag. If the title is not set, an
empty string will be returned.

```php
grabPageTitle(): string
```



## `seeElement`

```php
seeElement(
    string $selector
): void
```



## `dontSeeElement`

```php
dontSeeElement(
    string $selector
): void
```



## `grabElement`

```php
grabElement(
    string $selector
): ?Symfony\Component\DomCrawler\Crawler
```
