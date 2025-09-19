---
layout: default
title: Typehinting Classes, Methods, and Functions
parent: Container Component
permalink: container/typehinting
nav_order: 5
---



# Typehinting Classes, Methods, and Functions

## Typehinting Classes

Classes can be called using the `typehintClass()` method:

```php
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Flash\FlashInterface;

/** @var ContainerInterface $container */

$flash = $container->typehintClass(FlashInterface::class);
```

Although constructor parameters will be saved in the Object Storage, the typehinted class will not be.



## Typehinting Methods

Methods can be called using the `typehintMethod()` method:

```php
$response = $container->typehintMethod($postController, "index");
```



## Typehinting Functions

Functions can be called using the `typehintFunction()` method.

```php
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\RequestInterface;

function my_special_function(ContainerInterface $container, RequestInterface $request)
{
    /* ... */
}

$result = $container->typehintFunction("my_special_function");
```



## Typehinting Services

```php
use App\Services\FlashService;

$flash = $container->typehintService(FlashService::class);
```
