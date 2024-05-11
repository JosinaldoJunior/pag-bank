<?php

namespace App\Services\Payment;

use App\Enums\RatePaymentMethod;

/**
 * @class PaymentBankSlip
 */
class PaymentBankSlip implements IPayment
{

    public function __construct(
        protected string $name_client,
        protected string $cpf,
        protected string $description,
        protected float $amount
    ) { }

    /**
     * @param array $data
     * @return void
     */
    public function makePayment()
    {
        $rate = $this->calculateRate();
        $this->amount = $this->amount - $rate;
//        dd($this->amount, 'EFETIVAR PAGAMENTO BANK SLIP!!!!');
    }

    /**
     * @param float $amount
     * @return float
     */
    public function calculateRate() : float
    {
        return $this->amount / 100 * RatePaymentMethod::BANK_SLIP;
    }
}
