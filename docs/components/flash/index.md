---
layout: default
title: Flash
parent: Components
has_children: true
permalink: flash
---



# `Centum\Flash`

`Centum\Flash\Flash` is used to display messages to users.
Messages are stored in the session so they are useful for providing information after a form submission or redirect.

```php
Centum\Flash\Flash(
    Centum\Http\Session $session,
    Centum\Flash\FormatterInterface $formatter
);
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
