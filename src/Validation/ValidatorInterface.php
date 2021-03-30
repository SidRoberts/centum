<?php

namespace Centum\Validation;

interface ValidatorInterface
{
    public function validate(mixed $value): bool;

    public function getMessages(): array;
}
