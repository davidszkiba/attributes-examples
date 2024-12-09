<?php

declare(strict_types=1);

namespace Demo\Validation;

#[\Attribute]
class NotEmpty {
    public function validate($value): bool {
        return !empty($value);
    }
}
