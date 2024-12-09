<?php
#[PaymentProcessor("klarna")]
class KlarnaPayment implements PaymentInterface {
    public function process(float $amount): bool {
        echo "Processing \${$amount} with Klarna\n";
        return true;
    }
}
