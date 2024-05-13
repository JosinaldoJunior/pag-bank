<?php

namespace App\Factories;

abstract class Payment
{
    abstract public function getPaymentType(): IPayment;

    public function pay($data) : \App\Models\Payment
    {
        $paymentType = $this->getPaymentType();
        return $paymentType->pay($data);
    }
}
