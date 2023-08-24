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
    array<string, mixed> $data = [],
    Centum\Interfaces\Http\FilesInterface $files = null
): void
```



## `see`

```php
see(
    string $needle
): void
```



## `dontSee`

```php
dontSee(
    string $needle
): void
```



## `seeInSource`

```php
seeInSource(
    string $needle
): void
```



## `dontSeeInSource`

```php
dontSeeInSource(
    string $needle
): void
```



## `seeInPageTitle`

```php
seeInPageTitle(
    string $needle
): void
```



## `dontSeeInPageTitle`

```php
dontSeeInPageTitle(
    string $needle
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
