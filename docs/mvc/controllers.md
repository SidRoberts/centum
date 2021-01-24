---
layout: default
title: Controllers
parent: Mvc
---



All controllers should extend [`Centum\Mvc\Controller`](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Controller.php).
Specify what services you require in the method signature.

Every public method is classed as an action and, although they do not require a suffix (you're free to call it however you want), they must have a [`Centum\Mvc\Router\Route\Uri`](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Router/Route/Uri.php) annotation.

```php
use Auth;
use Doctrine\ORM\EntityManager;
use Centum\Mvc\Router\Route\Uri;

#[Uri("/this/is/your/url")]
public function index(Auth $auth, EntityManager $doctrine)
{
    //TODO
}
```

## URL Parameters

You can also create URLs with dynamic values by enclosing their identifier in curly brackets (eg. `{id}`).
These values are available from the [`Centum\Mvc\Parameters`](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Parameters.php) object:

```php
use Centum\Mvc\Parameters;
use Centum\Mvc\Router\Route\Uri;

#[Uri("/post/{id}")]
public function viewSingle(Parameters $parameters)
{
    $id = $parameters->get("id");

    //TODO Do something with $id.
}

#[Uri("/something-crazy/{a}/{b}/{c}")]
public function something(Parameters $parameters)
{
    $a = $parameters->get("a");
    $b = $parameters->get("b");
    $c = $parameters->get("c");

    //TODO Do something with $a, $b and $c.
}
```

The `$parameters` property can be anywhere in the method signature.

## Parameter Requirements

You can also require that the parameters adhere to a certain regular expression.
This example will match `/post/1`, `/post/2`, `/post/3` and so on but will not match something like `/post/abc`:

```php
use Centum\Mvc\Parameters;
use Centum\Mvc\Router\Route\Uri;
use Centum\Mvc\Router\Route\Requirement;

#[Uri("/post/{id}")]
#[Requirement("id", "\d+")]
public function viewSingle(Parameters $parameters)
{
    $id = $parameters->get("id");

    //TODO Do something with $id.
}
```

## HTTP Methods

You can also specify which HTTP method to match (eg. `GET`, `POST`, `HEAD`, `PUT`, `DELETE`, `TRACE`, `OPTIONS`, `CONNECT`, `PATCH`):

```php
use Centum\Mvc\Router\Route\Uri;

#[Uri("/url", "GET")]
public function get()
{
    //TODO
}

#[Uri("/url", "POST")]
public function post()
{
    //TODO
}
```

By default, routes will only match `GET`.
