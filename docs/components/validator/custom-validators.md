---
layout: default
title: Custom Validators
parent: Validator
grand_parent: Components
permalink: validator/custom-validators
nav_order: 1
---



# Custom Validators

Validators must implement [`Centum\Interfaces\Validator\ValidatorInterface`](https://github.com/SidRoberts/centum/tree/development/src/Interfaces/Validator/ValidatorInterface.php) and implement the following methods:

- `public function validate(mixed $value): string[]`

The `validate()` method returns an array of violations as strings.
An empty array has no violations meaning that the value is valid.

As an example, a Validator can be made to check the a value is not empty:

```php
namespace App\Validators;

use Centum\Interfaces\Validator\ValidatorInterface;

class NotEmptyValidator implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (empty($value)) {
            return [
                "Value is required and can't be empty.",
            ];
        }

        return [];
    }
}
```

(see also [`Centum\Validator\NotEmpty`](https://github.com/SidRoberts/centum/tree/development/src/Validator/NotEmpty.php)).

More complex Validators can be made by injecting other objects into the validator:

```php
namespace App\Validators;

use Centum\Interfaces\Validator\ValidatorInterface;
use DatePeriod;
use DateTimeInterface;

class WithinDatePeriodValidator implements ValidatorInterface
{
    public function __construct(
        protected readonly DatePeriod $datePeriod
    ) {
    }

    public function validate(mixed $value): array
    {
        if (!($value instanceof DateTimeInterface)) {
            return [
                "Value is not a DateTimeInterface",
            ];
        }

        foreach ($this->datePeriod as $dateTime) {
            if ($dateTime->format("U") === $value->format("U")) {
                return [];
            }
        }

        return [
            "Value is not in date period.",
        ];
    }
}
```
