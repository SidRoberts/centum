<?php

namespace Centum\Http;

use Centum\Forms\Form;

class Request
{
    protected string $uri;
    protected string $method;
    protected array $parameters;
    protected $content;



    public function __construct(string $uri, string $method = "GET", array $parameters = [], $content = null)
    {
        $this->uri        = $uri;
        $this->method     = strtoupper($method);
        $this->parameters = $parameters;
        $this->content    = $content;
    }



    public function getUri() : string
    {
        return $this->uri;
    }

    public function getMethod() : string
    {
        return $this->method;
    }

    public function getParameters() : array
    {
        return $this->parameters;
    }

    public function getContent()
    {
        return $this->content;
    }



    public function validate(Form $form) : bool
    {
        return $form->isValid($this->parameters);
    }

    public function getValidationMessages(Form $form) : array
    {
        return $form->getMessages($this->parameters);
    }
}
