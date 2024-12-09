<?php

declare(strict_types=1);

namespace Demo;

use Demo\Validation\NotEmpty;

class User {
    public function __construct(
        #[NotEmpty]
        private string $username,

        #[NotEmpty]
        private string $email,

        #[NotEmpty]
        private string $password
    ) {}

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }
}

