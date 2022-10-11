<?php

namespace Centum\Interfaces\Forms;

use Centum\Interfaces\Filter\FilterInterface;
use Centum\Interfaces\Validator\ValidatorInterface;

interface FieldInterface
{
    public function getName(): string;



    /**
     * @return array<FilterInterface>
     */
    public function getFilters(): array;

    /**
     * @return array<ValidatorInterface>
     */
    public function getValidators(): array;



    public function addFilter(FilterInterface $filter): void;

    public function addValidator(ValidatorInterface $validator): void;



    public function getFilteredValue(mixed $value): mixed;



    public function isValid(mixed $value): bool;



    /**
     * @return string[]
     */
    public function getMessages(mixed $value): array;
}
