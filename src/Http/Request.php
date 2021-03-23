<?php

namespace Centum\Http;

use Centum\Forms\Form;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends SymfonyRequest
{
    public function validate(Form $form) : bool
    {
        $data = match ($this->getMethod()) {
            "GET"   => $this->query->all(),
            default => $this->request->all(),
        };

        return $form->isValid($data);
    }

    public function getValidationMessages(Form $form) : array
    {
        $data = match ($this->getMethod()) {
            "GET"   => $this->query->all(),
            default => $this->request->all(),
        };

        return $form->getMessages($data);
    }
}
