<?php

namespace App\Factories;

use App\Repositories\Payment\PaymentRepository;
use App\Services\Merchant\MerchantService;
use App\Services\Payment\PaymentProvider;
use App\Services\Payment\PaymentBankSlip;

class BankSlipPay extends Payment
{
    private string $name_client;
    private string $cpf;
    private string $description;
    private float $amount;
    private PaymentProvider $paymentProvider;
    private PaymentRepository $paymentRepository;
    private MerchantService $merchantService;

    public function __construct(
        string $name_client,
        string $cpf, string
        $description,
        float $amount,
        PaymentProvider $paymentProvider,
        PaymentRepository $paymentRepository,
        MerchantService $merchantService)
    {
        $this->name_client = $name_client;
        $this->cpf = $cpf;
        $this->description = $description;
        $this->amount = $amount;
        $this->paymentProvider = $paymentProvider;
        $this->paymentRepository = $paymentRepository;
        $this->merchantService = $merchantService;
    }

    public function getPaymentType(): IPayment
    {
        return new PaymentBankSlip(
            $this->name_client,
            $this->cpf,
            $this->description,
            $this->amount,
            $this->paymentProvider,
            $this->paymentRepository,
            $this->merchantService
        );
    }
}
