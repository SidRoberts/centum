<?php

namespace Tests\Support\Forms;

use Centum\Http\Form;
use Centum\Interfaces\Container\ContainerInterface;
use Exception;

class LoginWithCsrfForm extends Form
{
    protected string $username;
    protected string $password;



    protected function set(ContainerInterface $container): void
    {
        $this->validateCsrf();

        $this->setUsername($container);
        $this->setPassword($container);
    }

    protected function setUsername(ContainerInterface $container): void
    {
        if (!$this->data->get("username")) {
            throw new Exception("Username is required.");
        }

        /** @var string */
        $username = $this->data->get("username");

        $this->username = $username;
    }

    protected function setPassword(ContainerInterface $container): void
    {
        if (!$this->data->get("password")) {
            throw new Exception("Password is required.");
        }

        /** @var string */
        $password = $this->data->get("password");

        if (strlen($password) < 6) {
            throw new Exception("Password is too short.");
        }

        $this->password = $password;
    }



    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
