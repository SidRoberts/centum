---
layout: default
title: Flash Component
has_children: true
permalink: flash
---



# `Centum\Flash`

[`Centum\Flash\Flash`](https://github.com/SidRoberts/centum/blob/main/src/Flash/Flash.php) is used to display messages to users.
Messages are stored in the session so they are useful for providing information after a form submission or redirect.
This makes it easy to provide feedback that persists across requests, such as error messages, success confirmations, or informational notices.

```php
Centum\Flash\Flash(
    Centum\Interfaces\Flash\StorageInterface $storage,
    Centum\Interfaces\Flash\FormatterInterface $formatter
);
```

{: .callout.info }
[`Centum\Flash\Flash`](https://github.com/SidRoberts/centum/blob/main/src/Flash/Flash.php) implements [`Centum\Interfaces\Flash\FlashInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Flash/FlashInterface.php).

To add a message to the Flash, use any of the following methods:
`danger()`, `success()`, `info()`, or `warning()`:

```php
$flash->danger(
    "This is an example message."
);
```

Each of these methods sets the appropriate message type, which can later be styled differently in your templates.
For example, you might display `danger` messages in red to indicate errors, while `success` messages appear in green to highlight positive feedback.
This separation helps guide the user’s attention and improves overall usability.

And now you can output the messages in your view:

```php
echo $flash->output();
```

The `output()` method will automatically fetch all stored messages, apply the formatter to ensure consistent presentation, and clear them from the session so that they are not displayed again.
This behaviour follows the typical "show once" nature of Flash messages.

If you're using Twig, you can also use the [Flash Twig extension](../twig/flash.md).
This makes it even easier to integrate messages into your templates without writing additional boilerplate code.



## Links

- [Source code (`src/Flash/`)](https://github.com/SidRoberts/centum/blob/main/src/Flash/)
- [Interfaces (`src/Interfaces/Flash/`)](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Flash/)
- [Unit tests (`tests/Unit/Flash/`)](https://github.com/SidRoberts/centum/blob/main/tests/Unit/Flash/)
