<?php

namespace Centum\Forms;

use Centum\Interfaces\Filter\FilterInterface;
use Centum\Interfaces\Forms\FieldInterface;
use Centum\Interfaces\Validator\ValidatorInterface;
use Throwable;

class Field implements FieldInterface
{
    /**
     * @var array<FilterInterface>
     */
    protected array $filters = [];

    /**
     * @var array<ValidatorInterface>
     */
    protected array $validators = [];



    /**
     * @param non-empty-string $name
     */
    public function __construct(
        protected readonly string $name
    ) {
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
            /** @var mixed */
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
        try {
            /** @var mixed */
            $filteredValue = $this->getFilteredValue($value);

            $allMessages = [];

            // Validate filtered value.
            foreach ($this->validators as $validator) {
                $messages = $validator->validate($filteredValue);

                array_push($allMessages, ...$messages);
            }
        } catch (Throwable $exception) {
            $exceptionMessage = $exception->getMessage();

            if ($exceptionMessage === "") {
                $exceptionMessage = $exception::class;
            }

            /** @var non-empty-string $exceptionMessage */
            return [
                $exceptionMessage,
            ];
        }

        return $allMessages;
    }
}
