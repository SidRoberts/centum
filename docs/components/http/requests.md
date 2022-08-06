---
layout: default
title: Requests
parent: Http
grand_parent: Components
---



# Requests

...



## Request Factory

You can obtain a Request object made with global variables using the [RequestFactory](https://github.com/SidRoberts/centum/blob/development/src/Http/RequestFactory.php):

```php
use Centum\Http\RequestFactory;

$requestFactory = new RequestFactory();

$request = $requestFactory->createFromGlobals();
```

Due to constraints with HTML forms (which only create GET or POST requests), the Request Factory allows the method to be overwritten using a POST field of `"_method"`.
