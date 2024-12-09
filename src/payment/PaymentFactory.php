<?php
class PaymentFactory {
    private array $processors = [];

    public function __construct() {
        // Get all PHP files in current directory
        $files = glob(__DIR__ . '/*.php');

        foreach ($files as $file) {
            // Get class name from filename
            $className = basename($file, '.php');

            // Skip if not a concrete payment class
            if ($className === 'PaymentFactory' ||
                $className === 'PaymentProcessor' ||
                !class_exists($className)) {
                continue;
            }

            // Check if class has PaymentProcessor attribute
            $reflection = new ReflectionClass($className);
            $attributes = $reflection->getAttributes(PaymentProcessor::class);

            if (!empty($attributes)) {
                $attribute = $attributes[0];
                $processor = $attribute->newInstance();
                $this->processors[$processor->name] = $className;
            }
        }
    }

    public function create(string $type): PaymentInterface {
        if (!isset($this->processors[$type])) {
            throw new \InvalidArgumentException(
                "Unknown payment type: $type. " .
                "Available types: " . implode(', ', array_keys($this->processors))
            );
        }

        $class = $this->processors[$type];
        return new $class();
    }

    // Helper method to see available processors
    public function getAvailableProcessors(): array {
        return array_keys($this->processors);
    }
}

