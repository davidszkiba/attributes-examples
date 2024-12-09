<?php

require_once 'PaymentInterface.php';
require_once 'PaymentProcessor.php';
require_once 'StripePayment.php';
require_once 'PaypalPayment.php';
require_once 'PaymentFactory.php';
require_once 'KlarnaPayment.php';

// Create factory
$factory = new PaymentFactory();

// Show available processors
echo "Available payment processors: " .
     implode(', ', $factory->getAvailableProcessors()) . "\n\n";

// Process payment with Stripe
try {
    $stripeProcessor = $factory->create('stripe');
    $stripeProcessor->process(99.99);
} catch (\InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

// Process payment with PayPal
try {
    $paypalProcessor = $factory->create('paypal');
    $paypalProcessor->process(149.99);
} catch (\InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

try {
    $factory->create('klarna')
        ->process(11.23);
} catch (\InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

// Try invalid processor
try {
    $invalidProcessor = $factory->create('bitcoin');
} catch (\InvalidArgumentException $e) {
    echo "\nError: " . $e->getMessage() . "\n";
}
