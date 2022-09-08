---
layout: default
title: Headers
parent: Http
grand_parent: Components
---



# Headers

...



## Headers Factory

You can obtain a Headers object made with global variables using the [HeadersFactory](https://github.com/SidRoberts/centum/blob/development/src/Http/HeadersFactory.php):

```php
use Centum\Http\HeadersFactory;

$headersFactory = new HeadersFactory();

$headers = $headersFactory->createFromGlobals();
```
