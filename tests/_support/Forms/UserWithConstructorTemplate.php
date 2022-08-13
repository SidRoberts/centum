<?php

namespace Tests\Forms;

use Centum\Container\Container;
use Centum\Filter\Cast\ToString;
use Centum\Filter\String\Trim;
use Centum\Forms\Field;
use Centum\Forms\FormTemplate;
use Centum\Validator\NotEmpty;

class UserWithConstructorTemplate extends FormTemplate
{
    protected Container $container;



    public function __construct(Container $container)
    {
        $this->container = $container;
    }



    public function username(Field $field): void
    {
        $field->addFilter(
            new ToString()
        );

        $field->addFilter(
            new Trim()
        );

        $field->addValidator(
            new NotEmpty()
        );
    }

    public function password(Field $field): void
    {
        $field->addFilter(
            new ToString()
        );

        $field->addValidator(
            new NotEmpty()
        );
    }
}
