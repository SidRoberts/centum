<?php

namespace Centum\Flash;

use Centum\Interfaces\Flash\FlashInterface;
use Centum\Interfaces\Flash\FormatterInterface;
use Centum\Interfaces\Flash\StorageInterface;

class Flash implements FlashInterface
{
    public function __construct(
        protected readonly StorageInterface $storage,
        protected readonly FormatterInterface $formatter
    ) {
    }



    public function success(string $text): void
    {
        $this->add(Level::SUCCESS, $text);
    }

    public function info(string $text): void
    {
        $this->add(Level::INFO, $text);
    }

    public function warning(string $text): void
    {
        $this->add(Level::WARNING, $text);
    }

    public function danger(string $text): void
    {
        $this->add(Level::DANGER, $text);
    }

    protected function add(Level $level, string $text): void
    {
        $messageBag = $this->storage->get();

        $message = new Message($level, $text);

        $messageBag->add($message);

        $this->storage->set($messageBag);
    }



    public function output(): string
    {
        $messageBag = $this->storage->get();

        $messages = $messageBag->getMessages();

        $output = "";

        foreach ($messages as $message) {
            $output .= $this->formatter->output($message) . PHP_EOL;
        }

        return $output;
    }
}
