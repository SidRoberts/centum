<?php

namespace Centum\Http;

use Centum\Forms\Form;
use Centum\Forms\Status;

class FormRequest
{
    protected Request $request;

    protected Form $form;

    protected Status $status;

    protected array $parameters;



    public function __construct(Request $request, Form $form)
    {
        $this->request = $request;
        $this->form    = $form;

        $this->status = $form->validate(
            $request->getParameters()
        );

        $this->parameters = $form->getFilteredValues(
            $request->getParameters()
        );
    }



    public function get(string $key): mixed
    {
        return $this->parameters[$key] ?? null;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function isValid(): bool
    {
        return $this->status->isValid();
    }
}
