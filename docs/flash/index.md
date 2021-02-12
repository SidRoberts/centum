---
layout: default
title: Flash
has_children: true
permalink: flash
---



# `Centum\Flash`

```php
use Centum\Flash\Flash;
use Centum\Flash\Formatter\TextFormatter;
use Centum\Http\Session;

$session   = new Session();
$formatter = new TextFormatter();

$flash = new Flash($session, $formatter);
```

To add a message to the Flash, use any of the following methods:
`danger()`, `success()`, `info()`, or `warning()`:

```php
$flash->danger(
    "This is an example message."
);
```

And now you can output the messages in your view:

```php
echo $flash->output();
```
