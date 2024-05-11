<?php

namespace App\Services\Payment;

interface IPaymentService
{
    public function getAllPayments();
    public function getOnePayment(string $idPayment);
    public function pay(array $dataPayment);
}
