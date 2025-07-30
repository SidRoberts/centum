---
layout: default
title: Custom Validators
parent: Validator
grand_parent: Components
permalink: validator/custom-validators
nav_order: 1
---



# Custom Validators

Custom Validators can be used anywhere you need to validate data, such as in Forms or Controllers.

{: .note }
Validators must implement [`Centum\Interfaces\Validator\ValidatorInterface`](https://github.com/SidRoberts/centum/tree/development/src/Interfaces/Validator/ValidatorInterface.php).

Validators require the following public method:

- `validate(mixed $value): list<non-empty-string>`

The `validate()` method returns an array of violations as strings.
An empty array means the value is valid.



## Example: Not Empty Validator

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

See also [`Centum\Validator\NotEmpty`](https://github.com/SidRoberts/centum/tree/development/src/Validator/NotEmpty.php).



## Example: Validator with Dependency Injection

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
