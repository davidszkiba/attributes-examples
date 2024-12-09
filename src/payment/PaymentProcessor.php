<?php
#[\Attribute]
class PaymentProcessor {
    public function __construct(
        public string $name
    ) {}
}
