<?php

namespace Tests\Support\Forms;

use Centum\Filter\Cast\ToString;
use Centum\Filter\String\Trim;
use Centum\Forms\Field;
use Centum\Forms\FormTemplate;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Validator\NotEmpty;

class UserWithConstructorTemplate extends FormTemplate
{
    public function __construct(
        protected readonly ContainerInterface $container
    ) {
    }



    public function username(Field $field): void
    {
        $field->addFilter(
            $this->container->get(ToString::class)
        );

        $field->addFilter(
            $this->container->get(Trim::class)
        );

        $field->addValidator(
            $this->container->get(NotEmpty::class)
        );
    }

    public function password(Field $field): void
    {
        $field->addFilter(
            $this->container->get(ToString::class)
        );

        $field->addValidator(
            $this->container->get(NotEmpty::class)
        );
    }
}
