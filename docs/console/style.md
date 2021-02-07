---
layout: default
title: Style
parent: Console
---



Writing plain text to the terminal can be pretty boring.
The Style class allows you to jazz up your terminal output with various text decorations.

```php
use Centum\Console\Terminal;
use Centum\Console\Terminal\Style;

$terminal = new Terminal();

$style = new Style();
```



# Text Color

The `text*()` methods allow you to change the color of the text:

```php
$terminal->write(
    $style->textRed("This text is red.") . PHP_EOL .
    $style->textGreen("This text is green.") . PHP_EOL .
    $style->textBlue("This text is blue.")
);
```

Producing:

```bash
{% raw %}<span style="color: red;">This text is red.</span>{% endraw %}
{% raw %}<span style="color: green;">This text is green.</span>{% endraw %}
{% raw %}<span style="color: blue;">This text is blue.</span>{% endraw %}
```



# Background Color

The `background*()` methods allow you to change the background color of the text:

```php
$terminal->write(
    $style->backgroundRed("This text has a red background.") . PHP_EOL .
    $style->backgroundGreen("This text has a green background.") . PHP_EOL .
    $style->backgroundBlue("This text has a blue background.")
);
```

Producing:

```bash
{% raw %}<span style="background-color: red;">This text has a red background.</span>{% endraw %}
{% raw %}<span style="background-color: green;">This text has a green background.</span>{% endraw %}
{% raw %}<span style="background-color: blue;">This text has a blue background.</span>{% endraw %}
```
