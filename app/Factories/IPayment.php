<?php

namespace App\Factories;

interface IPayment
{
    public function pay(Payment $payment);
    public function calculateRate() : int|float;
}
