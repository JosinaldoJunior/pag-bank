<?php

namespace App\Repositories\Payment;

use App\Models\Payment;

interface IPaymentRepository
{
    public function getAll();
    public function getOne(int $idPayment);
}
