<?php

namespace Centum\Interfaces\Flash;

interface StorageInterface
{
    public function get(): MessageBagInterface;

    public function set(MessageBagInterface $messageBag): void;

    public function reset(): void;
}
