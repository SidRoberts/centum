---
layout: default
title: Style
parent: Console
grand_parent: Components
permalink: console/style
nav_order: 3
---



# Style

Plain text output can be dull.
[`Centum\Console\Terminal\Style`](https://github.com/SidRoberts/centum/blob/development/src/Console/Terminal/Style.php) lets you enhance your terminal output with colors and decorations.



## Instantiating Style

```php
use Centum\Console\Terminal\Style;

$style = new Style();
```



### Displaying a List

```php
use Centum\Console\Terminal\Style;
use Centum\Interfaces\Console\TerminalInterface;

/** @var TerminalInterface $terminal */
/** @var Style $style */

$terminal->write(
    $style->list(
        [
            "Item 1",
            "Item 2",
            "Item 3",
        ]
    )
);
```



## Text Color

Use the `text*()` methods to change text color:

```php
$terminal->write(
    $style->textRed("This text is red.") . PHP_EOL .
    $style->textGreen("This text is green.") . PHP_EOL .
    $style->textBlue("This text is blue.")
);
```

Produces three lines of differently colored text.



## Background Color

Use the `background*()` methods to change the background color:

```php
$terminal->write(
    $style->backgroundRed("This text has a red background.") . PHP_EOL .
    $style->backgroundGreen("This text has a green background.") . PHP_EOL .
    $style->backgroundBlue("This text has a blue background.")
);
```

Produces three lines with differently colored backgrounds.



## Combining Decorations

You can nest style methods to combine effects:

```php
$terminal->write(
    $style->textYellow(
        $style->backgroundBlue(
            "This text is yellow and has a blue background."
        )
    )
);
```



## Additional Decorations

Style also supports other text decorations, such as bold and underline:

```php
$terminal->write(
    $style->bold("Bold text") . PHP_EOL .
    $style->italics("Italicised text") . PHP_EOL .
    $style->underline("Underlined text") . PHP_EOL .
    $style->highlight("Highlighted text") . PHP_EOL .
    $style->dim("Dimmed text") . PHP_EOL .
    $style->blink("Blinking text") . PHP_EOL .
    $style->reversed("Reversed text") // text colour becomes background colour, background colour becomes text colour
);
```
