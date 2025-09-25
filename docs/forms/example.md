---
layout: default
title: Example
parent: Forms Component
permalink: forms/example
nav_order: 1
---



# Example

Let's create a login form with an email and a password field.
First, we need to create these fields:

```php
use Centum\Forms\Field;

$emailField = new Field("email");

$passwordField = new Field("password");
```

{: .callout.info }
[`Centum\Forms\Field`](https://github.com/SidRoberts/centum/blob/main/src/Forms/Field.php) implements [`Centum\Interfaces\Forms\FieldInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Forms/FieldInterface.php).

Now we need to add some filters and validators to these fields.
The email field should not be empty and it should contain a valid email address:

```php
use Centum\Filter\String\Trim;
use Centum\Validator\EmailAddress;
use Centum\Validator\NotEmpty;

$emailField->addFilter(
    new Trim()
);

$emailField->addValidator(
    new NotEmpty()
);

$emailField->addValidator(
    new EmailAddress()
);
```

For the password field, we only need to make sure it is not empty, but in a real application you might also add length requirements or custom validators:

```php
use Centum\Validator\NotEmpty;

$passwordField->addValidator(
    new NotEmpty()
);
```

Filters are applied before validating the data, which means that unnecessary whitespace or formatting issues are taken care of before running checks against the field values.
This leads to more reliable validation and fewer false negatives.

Now we need to encapsulate them into a [`Centum\Forms\Form`](https://github.com/SidRoberts/centum/blob/main/src/Forms/Form.php):

```php
use Centum\Forms\Form;

$loginForm = new Form();

$loginForm->add($emailField);

$loginForm->add($passwordField);
```

At this point, our form is fully defined and ready to validate input data from a request.
It can be reused multiple times without redefining the logic, keeping the rest of your codebase more concise.



## Validating

Validating a Form is done using the `validate()` method which returns a [`Centum\Forms\Status`](https://github.com/SidRoberts/centum/blob/main/src/Forms/Status.php) object.
This object acts as a convenient wrapper around the result of the validation process, so you don’t have to manually inspect every field.
It has 2 public methods:

- `isValid(): bool`
- `getMessages(): array<string, array<string>>`

{: .callout.info }
[`Centum\Forms\Status`](https://github.com/SidRoberts/centum/blob/main/src/Forms/Status.php) implements [`Centum\Interfaces\Forms\StatusInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Forms/StatusInterface.php).

Validating data against these filters and validators is as easy as:

```php
$status = $loginForm->validate($_POST);

$success = $status->isValid();
```

If the data isn't valid, you can find out why:

```php
$status = $loginForm->validate($_POST);

$errorMessages = $status->getMessages();
```

The messages are returned in a structured format, grouped by field name.
This makes it simple to display clear and specific feedback to users, such as "Email address is required" or "Password cannot be empty".
By keeping validation logic in the form rather than scattered throughout your code, you make your application more robust, readable, and maintainable.
