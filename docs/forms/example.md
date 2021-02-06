---
layout: default
title: Example
parent: Forms
---



Let's create a login form with a email and a password field.
First, we need to create these fields:

```php
use Centum\Forms\Field;

$emailField = new Field("email");

$passwordField = new Field("password");
```

Now we need to add some filters and validators to these fields.
Obviously, neither of these fields should be empty and the email field should contain a valid email address:

```php
use Zend\Filter\StringTrim;
use Zend\Validator\NotEmpty;
use Zend\Validator\EmailAddress;



$emailField->addFilter(
    new StringTrim()
);

$emailField->addValidator(
    new NotEmpty()
);

$emailField->addValidator(
    new EmailAddress()
);



$passwordField->addValidator(
    new NotEmpty()
);
```

Filters are applied before validating the data.

Now we need to encapsulate them into a Form:

```php
use Centum\Forms\Form;

$loginForm = new Form();

$loginForm->add($emailField);

$loginForm->add($passwordField);
```

Validating data against these filters and validators is as easy as:

```php
$success = $loginForm->isValid($_POST);
```

If the data isn't valid, you can find out why:

```php
$errorMessages = $loginForm->getMessages($_POST);
```

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
