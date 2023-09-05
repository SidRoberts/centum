<?php

namespace Centum\Forms;

use Centum\Interfaces\Forms\StatusInterface;

class Status implements StatusInterface
{
    /**
     * @param array<non-empty-string, array<non-empty-string>> $messages
     */
    public function __construct(
        protected readonly array $messages
    ) {
    }



    public function isValid(): bool
    {
        return (count($this->messages) === 0);
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}
