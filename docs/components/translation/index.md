---
layout: default
title: Translation
parent: Components
has_children: true
permalink: translation
---



# `Centum\Translation`

The Translation component provides a simple way to translate strings into multiple languages.

Translated strings are stored within [`Centum\Interfaces\Translation\LocaleInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Translation/LocaleInterface.php) objects.

```php
Centum\Translate\Locale(
    string $code,
    array $translations
);
```

{: .highlight }
[`Centum\Translation\Locale`](https://github.com/SidRoberts/centum/blob/main/src/Translation/Locale.php) implements [`Centum\Interfaces\Translation\LocaleInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Translation/LocaleInterface.php).

```php
use Centum\Translation\Locale;

$enLocale = new Locale(
    "en",
    [
        "_footer" => [
            "copyright" => "(c) 2025 Your Name.",
        ],
        "index/index" => [
            "greeting" => "Hello, {name}!",
            "welcome"  => "Welcome to this website.",
        ],
    ]
);
```

Translation strings are stored using domains and keys.
This keeps your translations organised, scalable, and maintainable — especially when your project grows or you add more languages.

In the above example, the domains are `"_footer"` and `"index/index"` and the keys are `"copyright"`, `"greeting"`, and `"copyright"`.
You could have a domain for each view template you have.

Once we have a Locale object, we can create a Translator.

```php
use Centum\Translation\Translator;

$translator = new Translator($enLocale);
```

{: .highlight }
[`Centum\Translation\Translator`](https://github.com/SidRoberts/centum/blob/main/src/Translation/Translator.php) implements [`Centum\Interfaces\Translation\TranslatorInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Translation/TranslatorInterface.php).



## Translating Strings

To translate a string, use the `translate()` method:

```php
$translator->translate($domain, $key, $replaceValues = []);
```

- **`$domain`**: The section or category of the translation (e.g. `"_footer"`, `"index/index"`).
- **`$key`**: The specific string to translate within that domain (e.g. `"copyright"`, `"greeting"`, `"welcome"`).
- **`$replaceValues`** *(optional)*: An array of placeholder values to be replaced inside the translation string.

For example:

```php
echo $translator->translate("index/index", "welcome");
```

The output will be:

```text
Welcome to this website.
```



### Placeholders / Replace Values

Strings can include placeholders, written as `{placeholder}`.
When calling `translate()`, you can provide values to replace them.
For example:

```php
$translator->translate(
    "index/index",
    "greeting",
    [
        "name" => "Alice",
    ]
);
```

The output will be:

```text
Hello, Alice!
```

Centum uses the [ICU Message Format](https://format-message.github.io/icu-message-format-for-translators/index.html#learn-more) which allows placeholders to include data types, pluralisation rules, and conditional selections.
You can try it out online using the [Online ICU Message Editor](https://format-message.github.io/icu-message-format-for-translators/editor.html).



#### Quick Summary

##### Variable Interpolation

`{name}`

##### Number formatting

- `{age, number}`
- `{age, number, integer}`
- `{price, number, currency}`
- `{progress, number, percent}`

##### Pluralisation

```text
{count, plural,
    one {1 item}
    other {# items}}
```

```text
{num_guests, plural,
    =0 {No guests.}
    =1 {Only 1 guest.}
    =2 {Just 2 guests.}
    other {# guests.}}
```

##### Select (conditional)

```text
{gender, select,
    male {He}
    female {She}
    other {They}}
```

##### Date Formatting

- `{date, date, short}`
- `{date, date, medium}`
- `{date, date, long}`
- `{date, date, full}`
- `{date, date, ::d MMMM yyyy}` ([available symbols](https://unicode-org.github.io/icu/userguide/format_parse/datetime/#date-field-symbol-table))

##### Time Formatting

- `{date, time, short}`
- `{date, time, medium}`
- `{date, time, long}`
- `{date, time, full}`
