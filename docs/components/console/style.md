---
layout: default
title: Style
parent: Console
grand_parent: Components
permalink: console/style
nav_order: 3
---



# Style

Writing plain text to the terminal can be pretty boring.
[`Centum\Console\Terminal\Style`](https://github.com/SidRoberts/centum/blob/development/src/Console/Terminal/Style.php) allows you to jazz up your terminal output with various text decorations.

```php
Centum\Console\Terminal\Style();
```



## Text Color

The `text*()` methods allow you to change the color of the text:

```php
use Centum\Console\Terminal\Style;
use Centum\Interfaces\Console\TerminalInterface;

/** @var TerminalInterface $terminal */
/** @var Style $style */

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
use Centum\Console\Terminal\Style;
use Centum\Interfaces\Console\TerminalInterface;

/** @var TerminalInterface $terminal */
/** @var Style $style */

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
use Centum\Console\Terminal\Style;
use Centum\Interfaces\Console\TerminalInterface;

/** @var TerminalInterface $terminal */
/** @var Style $style */

$terminal->write(
    $style->textYellow(
        $style->backgroundBlue(
            "This text is yellow and has a blue background."
        )
    )
);
```
