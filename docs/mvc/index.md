---
layout: default
title: Mvc
has_children: true
permalink: mvc
---



# `Centum\Mvc`

A controller can be as simple as this:

```php
use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;

class IndexController
{
    public function index() : Response
    {
        return new Response("hello");
    }
}
```

The Router's job is to convert a [Request](https://github.com/SidRoberts/centum/blob/development/src/Http/Request.php) object into a [Response](https://github.com/SidRoberts/centum/blob/development/src/Http/Response.php) object.
It does so by extracting the Request's URI, it iterates through the Routes until it finds one that matches, and then executes the Controller's code which returns a Response.
