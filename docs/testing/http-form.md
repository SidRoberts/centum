---
layout: default
title: HTTP Form Actions
parent: Testing
permalink: testing/http-form
---



# HTTP Form Actions

[`Centum\Codeception\Actions\HttpFormActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/HttpFormActions.php)



## `buildForm`

```php
buildForm(
    class-string<T> $formClass,
    Centum\Interfaces\Http\DataInterface $data,
    Centum\Interfaces\Http\FilesInterface $files = null
): T
```



## `expectFormThrowable`

```php
expectFormThrowable(
    class-string<Throwable>|interface-string<Throwable>|Throwable $expectedThrowable,
    class-string<Centum\Interfaces\Http\FormInterface> $formClass,
    Centum\Interfaces\Http\DataInterface $data,
    Centum\Interfaces\Http\FilesInterface $files = null
): void
```
