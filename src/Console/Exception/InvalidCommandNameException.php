<?php

namespace Centum\Console\Exception;

use Centum\Interfaces\Console\CommandInterface;

class InvalidCommandNameException extends \Exception
{
    protected readonly CommandInterface $command;



    public function __construct(CommandInterface $command)
    {
        $message = sprintf(
            "Command name ('%s') is not valid.",
            $command->getName()
        );

        parent::__construct($message);

        $this->command = $command;
    }



    public function getCommand(): CommandInterface
    {
        return $this->command;
    }
}
