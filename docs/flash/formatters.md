---
layout: default
title: Formatters
parent: Flash Component
permalink: flash/formatters
nav_order: 1
---



# Formatters

Formatters determine how messages are outputted.
They take the raw message text and wrap or modify it in a consistent way so that the final result can be displayed to the user.
This ensures that messages are styled and formatted in a predictable manner, regardless of where they originate in the application.

{: .callout.info }
Formatters must implement [`Centum\Interfaces\Flash\FormatterInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Flash/FormatterInterface.php).

Currently, there are 2 formatters included by default.
These cover the most common use cases, but you are free to extend the system with additional formatters if needed, such as JSON output for APIs or logging purposes.



## [`HtmlFormatter`](https://github.com/SidRoberts/centum/blob/main/src/Flash/Formatter/HtmlFormatter.php)

The `HtmlFormatter` generates HTML output suitable for use in web applications.
It typically wraps the message in styled HTML elements, making it easy to integrate with CSS frameworks like Bootstrap.

```html
<div class="alert alert-danger">This is an example message.</div>
```

You can style different message types with distinct colours and layouts, ensuring that warnings, errors, and success notifications are visually distinct and immediately recognisable to the user.



## [`TextFormatter`](https://github.com/SidRoberts/centum/blob/main/src/Flash/Formatter/TextFormatter.php)

The `TextFormatter` outputs messages in plain text, making it well-suited for logs or environments where HTML is not appropriate.
Instead of visual styling, it relies on text prefixes to indicate the message type.

```text
[DANGER] This is an example message.
```

This approach keeps the output simple and readable in contexts where extra formatting is unnecessary or unsupported, while still conveying the severity or category of the message.



## Example: Creating a Custom Formatter

In addition to the built-in formatters, you can create your own by implementing the [`FormatterInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Flash/FormatterInterface.php).
For example, a JSON formatter might be useful if you are returning messages from an API:

```php
<?php

namespace App\Flash\Formatter;

use Centum\Interfaces\Flash\FormatterInterface;

class JsonFormatter implements FormatterInterface
{
    public function output(MessageInterface $message): string
    {
        return json_encode(
            [
                "level" => $message->getLevel(),
                "text"  => $message->getText(),
            ]
        );
    }
}
```

This formatter would output something like:

```json
{"level":"danger","text":"This is an example message."}
```
