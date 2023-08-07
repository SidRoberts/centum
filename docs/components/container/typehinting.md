---
layout: default
title: Typehinting Methods and Functions
parent: Container
grand_parent: Components
permalink: container/typehinting
---



# Typehinting Methods and Functions

## Typehinting Methods

Methods can be called using the `typehintMethod()` method:

```php
$response = $container->typehintMethod($postController, "index");
```


## Typehinting Functions

Functions can be called using the `typehintFunction()` method.

```php
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Container\ContainerInterface;

function my_special_function(ContainerInterface $container, RequestInterface $request)
{
    /* ... */
}

$result = $container->typehintFunction("my_special_function");
```
