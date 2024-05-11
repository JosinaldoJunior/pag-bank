<?php

namespace App\Services\Payment;

interface IPayment
{
    public function makePayment() : array;
    public function calculateRate() : float;
}
