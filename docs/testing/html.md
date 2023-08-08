---
layout: default
title: HTML Actions
parent: Testing
permalink: testing/html
---



# HTML Actions

[`Centum\Codeception\Actions\HtmlActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/HtmlActions.php)

- `grabTextContent(): string`
- `submitForm(string $selector, array $data = [], Centum\Interfaces\Http\FilesInterface $files = null): void`
- `see(string $needle): void`
- `dontSee(string $needle): void`
- `seeInSource(string $needle): void`
- `dontSeeInSource(string $needle): void`
- `seeInPageTitle(string $needle): void`
- `dontSeeInPageTitle(string $needle): void`
- `grabPageTitle(): string`
- `seeElement(string $selector): void`
- `dontSeeElement(string $selector): void`
- `grabElement(string $selector): Crawler|null`
