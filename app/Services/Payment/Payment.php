<?php

namespace App\Services\Payment;

class Payment
{

    public function makePay(IPayment $IPaymentService) : array
    {
        $IPaymentService->calculateRate();
        return $IPaymentService->makePayment();
    }
}
