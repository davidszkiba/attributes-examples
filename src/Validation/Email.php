<?php

declare(strict_types=1);

namespace Demo\Validation;

#[\Attribute]
class Email {
    public function validate($value): bool {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}
