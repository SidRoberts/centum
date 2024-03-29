<?php

namespace Centum\Interfaces\Flash;

interface MessageBagInterface
{
    public function add(MessageInterface $message): void;



    /**
     * @return array<MessageInterface>
     */
    public function getMessages(): array;
}
