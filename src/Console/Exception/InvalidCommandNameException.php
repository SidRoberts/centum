<?php

namespace Centum\Console\Exception;

use Centum\Interfaces\Console\CommandInterface;

class InvalidCommandNameException extends \Exception
{
    public function __construct(
        protected readonly CommandInterface $command
    ) {
        $message = sprintf(
            "Command name ('%s') is not valid.",
            $command->getName()
        );

        parent::__construct($message);
    }



    public function getCommand(): CommandInterface
    {
        return $this->command;
    }
}
