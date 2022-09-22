<?php

namespace Centum\Forms;

class Status
{
    /** @var array<string, string[]> */
    protected readonly array $messages;



    /**
     * @param array<string, string[]> $messages
     */
    public function __construct(array $messages)
    {
        $this->messages = $messages;
    }



    public function isValid(): bool
    {
        return (count($this->messages) === 0);
    }

    /**
     * @return array<string, string[]>
     */
    public function getMessages(): array
    {
        return $this->messages;
    }
}
