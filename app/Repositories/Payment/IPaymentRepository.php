<?php

namespace App\Repositories\Payment;

interface IPaymentRepository
{
    public function getAll();
    public function getOne(string $idPayment);
}
