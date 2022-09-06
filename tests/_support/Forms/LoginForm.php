<?php

namespace Tests\Forms;

use Centum\Container\Container;
use Centum\Http\Form;
use Exception;

class LoginForm extends Form
{
    protected string $username;
    protected string $password;



    protected function set(Container $container): void
    {
        $this->setUsername($container);
        $this->setPassword($container);
    }

    protected function setUsername(Container $container): void
    {
        if (empty($this->data["username"])) {
            throw new Exception("Username is required.");
        }

        /** @var string */
        $this->username = $this->data["username"];
    }

    protected function setPassword(Container $container): void
    {
        if (empty($this->data["password"])) {
            throw new Exception("Password is required.");
        }

        /** @var string */
        $password = $this->data["password"];

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
