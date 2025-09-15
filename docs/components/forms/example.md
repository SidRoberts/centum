---
layout: default
title: Example
parent: Forms
grand_parent: Components
permalink: forms/example
nav_order: 1
---



# Example

Let's create a login form with a email and a password field.
First, we need to create these fields:

```php
use Centum\Forms\Field;

$emailField = new Field("email");

$passwordField = new Field("password");
```

{: .highlight }
[`Centum\Forms\Field`](https://github.com/SidRoberts/centum/blob/main/src/Forms/Field.php) implements [`Centum\Interfaces\Forms\FieldInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Forms/FieldInterface.php).

Now we need to add some filters and validators to these fields.
Obviously, neither of these fields should be empty and the email field should contain a valid email address:

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

```php
use Centum\Validator\NotEmpty;

$passwordField->addValidator(
    new NotEmpty()
);
```

Filters are applied before validating the data.

Now we need to encapsulate them into a [`Centum\Forms\Form`](https://github.com/SidRoberts/centum/blob/main/src/Forms/Form.php):

```php
use Centum\Forms\Form;

$loginForm = new Form();

$loginForm->add($emailField);

$loginForm->add($passwordField);
```



## Validating

Validating a Form is done using the `validate()` method which returns a [`Centum\Forms\Status`](https://github.com/SidRoberts/centum/blob/main/src/Forms/Status.php) object.
It has 2 public methods:

- `public function isValid(): bool`
- `public function getMessages(): array<string, array<string>>`

{: .highlight }
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
