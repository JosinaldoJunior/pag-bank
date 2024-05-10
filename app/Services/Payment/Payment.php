<?php

namespace App\Services\Payment;

class Payment
{

    public function efetivarPagamento(IPayment $IPaymentService)
    {
        $IPaymentService->pagar();
    }
}
