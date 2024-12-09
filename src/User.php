<?php

declare(strict_types=1);

namespace Demo;

use Demo\Validation\NotEmpty;
use Demo\Validation\Email;
use Demo\Validation\MinLength;

class User {
    public function __construct(
        #[NotEmpty]
        #[MinLength(3)]
        private string $username,

        #[NotEmpty]
        #[Email]
        private string $email,

        #[NotEmpty]
        #[MinLength(8)]
        private string $password
    ) {}

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }
}

