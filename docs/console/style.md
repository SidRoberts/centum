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
[31mThis text is red.[0m
[32mThis text is green.[0m
[34mThis text is blue.[0m
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
[41mThis text has a red background.[0m
[42mThis text has a green background.[0m
[44mThis text has a blue background.[0m
```
