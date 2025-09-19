---
layout: default
title: Templates
parent: Forms Component
permalink: forms/templates
nav_order: 2
---



# Templates

To reuse the same form in multiple places, you can define the fields in a Form Template.
Form Templates are designed to simplify the process of creating Forms.

In a Form Template, each public method represents a [`Centum\Forms\Field`](https://github.com/SidRoberts/centum/blob/main/src/Forms/Field.php).
The Field's name is defined as the method's name.
The Field is passed as a parameter and does not need to be returned.

```php
namespace App\Forms;

use Centum\Filter\String\Trim;
use Centum\Forms\Field;
use Centum\Forms\FormTemplate;
use Centum\Validator\NotEmpty;

class LoginTemplate extends FormTemplate
{
    public function username(Field $field): void
    {
        $field->addFilter(
            new Trim()
        );

        $field->addValidator(
            new NotEmpty()
        );
    }

    public function password(Field $field): void
    {
        $field->addValidator(
            new NotEmpty()
        );
    }
}
```

You can then use the [`FormFactory`](https://github.com/SidRoberts/centum/tree/development/src/Forms/FormFactory.php) class to create the actual Form:

```php
use App\Forms\LoginTemplate;
use Centum\Forms\FormFactory;

$template = new LoginTemplate();

$formFactory = new FormFactory();

$form = $formFactory->createFromTemplate($template);
```
