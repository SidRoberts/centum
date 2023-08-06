<?php

namespace Tests\Support\Http\Forms;

use InvalidArgumentException;

class FormWithoutAConstructor
{
    protected string $username = "admin";
    protected string $password = "password";



    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        if (strlen($username) === 0) {
            throw new InvalidArgumentException("Username cannot be empty.");
        }

        $this->username = $username;
    }



    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        if (strlen($password) < 6) {
            throw new InvalidArgumentException("Password is too short.");
        }

        $this->password = $password;
    }
}
