<?php

namespace Tests\Support\Http\Forms;

use Centum\Interfaces\Http\FormInterface;
use Exception;

class LoginForm implements FormInterface
{
    public function __construct(
        protected readonly string $username,
        protected readonly string $password
    ) {
        if (strlen($username) === 0) {
            throw new Exception("Username cannot be empty.");
        }

        if (strlen($password) < 6) {
            throw new Exception("Password is too short.");
        }
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
