<?php

namespace Centum\Http;

use Centum\Forms\Form;

class Request
{
    protected string $uri;
    protected string $method;
    protected array $parameters;
    protected Headers $headers;
    protected Cookies $cookies;
    protected ?string $content;



    /**
     * @param Header[] $headers
     * @param Cookie[] $cookies
     */
    public function __construct(string $uri, string $method = "GET", array $parameters = [], array $headers = [], array $cookies = [], string $content = null)
    {
        $this->uri        = $uri;
        $this->method     = strtoupper($method);
        $this->parameters = $parameters;
        $this->headers    = new Headers($headers);
        $this->cookies    = new Cookies($cookies);
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

    public function getHeaders() : Headers
    {
        return $this->headers;
    }

    public function getCookies() : Cookies
    {
        return $this->cookies;
    }

    public function getContent() : ?string
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
