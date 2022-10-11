<?php

namespace Centum\Interfaces\Forms;

interface FormInterface
{
    public function add(FieldInterface $field): void;



    /**
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function getFilteredValues(array $data): array;



    /**
     * @param array<string, mixed> $data
     */
    public function validate(array $data): StatusInterface;
}
