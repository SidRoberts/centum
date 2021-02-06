---
layout: default
title: Templates
parent: Forms
---



To reuse the same form in multiple places, you can define the fields in a Form Template.
Form Templates are designed to simplify the process of creating Forms.

In a Form Template, each public method represents a Field.
The Field's name is defined as the method's name.
The Field is passed as a parameter and does not need to be returned.

```php
namespace App\Forms;

use Centum\Forms\Field;
use Centum\Forms\FormTemplate;
use Zend\Filter\StringTrim;
use Zend\Validator\NotEmpty;

class LoginTemplate extends FormTemplate
{
    public function username(Field $field)
    {
        $field->addFilter(
            new StringTrim()
        );

        $field->addValidator(
            new NotEmpty()
        );
    }

    public function password(Field $field)
    {
        $field->addValidator(
            new NotEmpty()
        );
    }
}
```

You can then use the Factory class to build the actual Form:

```php
use App\Forms\LoginTemplate;
use Centum\Forms\Factory;

$loginTemplate = new LoginTemplate();

$loginForm = Factory::build($template);
```
