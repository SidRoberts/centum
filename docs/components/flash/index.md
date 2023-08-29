---
layout: default
title: Flash
parent: Components
has_children: true
permalink: flash
---



# `Centum\Flash`

[`Centum\Flash\Flash`](https://github.com/SidRoberts/centum/blob/development/src/Flash/Flash.php) is used to display messages to users.
Messages are stored in the session so they are useful for providing information after a form submission or redirect.

```php
Centum\Flash\Flash(
    Centum\Interfaces\Flash\StorageInterface $storage,
    Centum\Interfaces\Flash\FormatterInterface $formatter
);
```

{: .highlight }
[`Centum\Flash\Flash`](https://github.com/SidRoberts/centum/blob/development/src/Flash/Flash.php) implements [`Centum\Interfaces\Flash\FlashInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Flash/FlashInterface.php).

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

If you're using Twig, you can also use the [Flash Twig extension](../twig/flash.md).
