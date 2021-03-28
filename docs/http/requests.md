---
layout: default
title: Requests
parent: Http
---



# Requests

...

You can obtain a Request object made with global variables using the [RequestFactory](https://github.com/SidRoberts/centum/blob/development/src/Http/RequestFactory.php):

```php
use Centum\Http\RequestFactory;

$request = RequestFactory::createFromGlobals();
```
