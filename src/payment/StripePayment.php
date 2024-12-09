<?php
#[PaymentProcessor("stripe")]
class StripePayment implements PaymentInterface {
    public function process(float $amount): bool {
        echo "Processing \${$amount} with Stripe\n";
        return true;
    }
}
