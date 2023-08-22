<?php

namespace Centum\Flash;

use Centum\Interfaces\Flash\MessageBagInterface;
use Centum\Interfaces\Flash\MessageInterface;

class MessageBag implements MessageBagInterface
{
    /** @var array<MessageInterface> */
    protected array $messages = [];



    public function add(MessageInterface $message): void
    {
        $this->messages[] = $message;
    }



    /**
     * @return array<MessageInterface>
     */
    public function getMessages(): array
    {
        return $this->messages;
    }
}
