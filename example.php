<?php

declare(strict_types=1);

require_once __DIR__ . '/src/Validation/NotEmpty.php';
require_once __DIR__ . '/src/User.php';
require_once __DIR__ . '/src/Validator.php';

use Demo\User;
use Demo\Validator;

try {
    // Valid user
    $validUser = new User(
        "johndoe",
        "john@example.com",
        "password123"
    );

    $validator = new Validator();
    $errors = $validator->validate($validUser);
    echo "Valid user validation errors: " . PHP_EOL;
    print_r($errors); // Should be empty

    // Invalid user
    $invalidUser = new User(
        "", // too short
        "not-an-email",
        "short"  // too short
    );

    $errors = $validator->validate($invalidUser);
    echo "\nInvalid user validation errors: " . PHP_EOL;
    print_r($errors);

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
