<?php

namespace Centum\Flash;

use Centum\Interfaces\Flash\MessageBagInterface;
use Centum\Interfaces\Flash\MessageInterface;

class MessageBag implements MessageBagInterface
{
    /**
     * @var list<MessageInterface>
     */
    protected array $messages = [];



    public function add(MessageInterface $message): void
    {
        $this->messages[] = $message;
    }



    public function getMessages(): array
    {
        return $this->messages;
    }
}
