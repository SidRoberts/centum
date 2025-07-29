<?php

namespace Tests\Support\Http\Forms;

use Centum\Interfaces\Http\FormInterface;
use Exception;

final class LoginForm implements FormInterface
{
    public function __construct(
        protected readonly string $username,
        protected readonly string $password
    ) {
        if (mb_strlen($username) === 0) {
            throw new Exception("Username cannot be empty.");
        }

        if (mb_strlen($password) < 6) {
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
