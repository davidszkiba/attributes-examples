<?php
interface PaymentInterface {
    public function process(float $amount): bool;
}
