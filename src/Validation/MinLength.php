<?php

declare(strict_types=1);

namespace Demo\Validation;

#[\Attribute]
class MinLength {
    public function __construct(
        private int $length
    ) {}

    public function validate($value): bool {
        return strlen($value) >= $this->length;
    }
}
