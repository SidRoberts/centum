<?php

namespace Centum\Forms;

use Centum\Filter\FilterInterface;
use Centum\Validator\ValidatorInterface;

class Field
{
    protected string $name;

    /**
     * @var FilterInterface[]
     */
    protected array $filters = [];

    /**
     * @var ValidatorInterface[]
     */
    protected array $validators = [];



    public function __construct(string $name)
    {
        $this->name = $name;
    }



    public function getName(): string
    {
        return $this->name;
    }



    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getValidators(): array
    {
        return $this->validators;
    }



    public function addFilter(FilterInterface $filter): void
    {
        $this->filters[] = $filter;
    }

    public function addValidator(ValidatorInterface $validator): void
    {
        $this->validators[] = $validator;
    }



    public function getFilteredValue(mixed $value): mixed
    {
        // Apply filters to value.
        foreach ($this->filters as $filter) {
            /**
             * @var mixed
             */
            $value = $filter->filter($value);
        }

        return $value;
    }



    public function isValid(mixed $value): bool
    {
        $messages = $this->getMessages($value);

        return (count($messages) === 0);
    }



    public function getMessages(mixed $value): array
    {
        /**
         * @var mixed
         */
        $filteredValue = $this->getFilteredValue($value);

        $allMessages = [];

        // Validate filtered value.
        foreach ($this->validators as $validator) {
            $messages = $validator->validate($filteredValue);

            if (is_array($messages)) {
                array_push($allMessages, ...$messages);
            }
        }

        return $allMessages;
    }
}
