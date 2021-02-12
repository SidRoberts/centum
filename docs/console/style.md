---
layout: default
title: Style
parent: Console
---



# Style

Writing plain text to the terminal can be pretty boring.
The Style class allows you to jazz up your terminal output with various text decorations.

```php
use Centum\Console\Terminal;
use Centum\Console\Terminal\Style;

$terminal = new Terminal();

$style = new Style();
```



## Text Color

The `text*()` methods allow you to change the color of the text:

```php
$terminal->write(
    $style->textRed("This text is red.") . PHP_EOL .
    $style->textGreen("This text is green.") . PHP_EOL .
    $style->textBlue("This text is blue.")
);
```

Produces three lines of different colored text.



## Background Color

The `background*()` methods allow you to change the background color of the text:

```php
$terminal->write(
    $style->backgroundRed("This text has a red background.") . PHP_EOL .
    $style->backgroundGreen("This text has a green background.") . PHP_EOL .
    $style->backgroundBlue("This text has a blue background.")
);
```

Produces three lines of text with different colored backgrounds.



## Combining Decorations

Style decorations can be combined to produce more interesting effects.

```php
$terminal->write(
    $style->textYellow(
        $style->backgroundBlue(
            "This text is yellow and has a blue background."
        )
    )
);
```
