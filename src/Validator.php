<?php

declare(strict_types=1);

namespace Demo;

class Validator {
    public function validate(object $object): array {
        $errors = [];
        $reflection = new \ReflectionClass($object);

        foreach ($reflection->getProperties() as $property) {
            $value = $property->getValue($object);

            foreach ($property->getAttributes() as $attribute) {
                $validator = $attribute->newInstance();
                if (!$validator->validate($value)) {
                    $errors[] = sprintf(
                        "Validation failed for property '%s' with validator '%s'",
                        $property->getName(),
                        $attribute->getName()
                    );
                }
            }
        }

        return $errors;
    }
}
