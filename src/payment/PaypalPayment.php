<?php
#[PaymentProcessor("paypal")]
class PayPalPayment implements PaymentInterface {
    public function process(float $amount): bool {
        echo "Processing \${$amount} with PayPal\n";
        return true;
    }
}
