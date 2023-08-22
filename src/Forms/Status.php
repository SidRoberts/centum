<?php

namespace Centum\Forms;

use Centum\Interfaces\Forms\StatusInterface;

class Status implements StatusInterface
{
    /**
     * @param array<string, array<string>> $messages
     */
    public function __construct(
        protected readonly array $messages
    ) {
    }



    public function isValid(): bool
    {
        return (count($this->messages) === 0);
    }

    /**
     * @return array<string, array<string>>
     */
    public function getMessages(): array
    {
        return $this->messages;
    }
}
