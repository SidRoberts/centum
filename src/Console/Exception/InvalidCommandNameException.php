<?php

namespace Centum\Console\Exception;

use Centum\Console\Command;

class InvalidCommandNameException extends \Exception
{
    protected readonly Command $command;



    public function __construct(Command $command)
    {
        $message = sprintf(
            "Command name ('%s') is not valid.",
            $command->getName()
        );

        parent::__construct($message);

        $this->command = $command;
    }



    public function getCommand(): Command
    {
        return $this->command;
    }
}
