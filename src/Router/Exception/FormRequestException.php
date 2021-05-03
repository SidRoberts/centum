<?php

namespace Centum\Router\Exception;

use Centum\Forms\Status;

class FormRequestException extends \Exception
{
    protected Status $status;



    public function __construct(Status $status)
    {
        $fieldMessages = [];

        foreach ($status->getMessages() as $field => $messages) {
            $fieldMessages[] = sprintf(
                "[%s]" . PHP_EOL . "%s",
                $field,
                implode(PHP_EOL, $messages)
            );
        }

        $exceptionMessage = implode(
            PHP_EOL . PHP_EOL,
            $fieldMessages
        );

        $this->status = $status;

        parent::__construct($exceptionMessage);
    }



    public function getStatus(): Status
    {
        return $this->status;
    }
}
