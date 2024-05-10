<?php

namespace App\Services\Payment;

interface IPayment
{
    public function pagar();
    public function calcularTaxa();
}
