<?php

namespace App\Services\Payment;

interface IPaymentService
{
    public function getAllPayments();
    public function getOnePayment(string $idPayment);
}
