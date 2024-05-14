<?php

namespace App\Services\Payment;

use App\Enums\PaymentMethod;
use App\Enums\RatePaymentMethod;
use App\Factories\IPayment;
use App\Factories\Payment;
use App\Repositories\Payment\PaymentRepository;
use App\Services\Merchant\MerchantService;

/**
 * @class PaymentBankSlip
 */
class PaymentBankSlip implements IPayment
{
    /**
     * @var string
     */
    private string $name_client;
    /**
     * @var string
     */
    private string $cpf;
    /**
     * @var string
     */
    private string $description;
    /**
     * @var float
     */
    private float $amount;
    /**
     * @var PaymentProvider
     */
    private PaymentProvider $paymentProvider;
    /**
     * @var PaymentRepository
     */
    private PaymentRepository $paymentRepository;
    /**
     * @var MerchantService
     */
    private MerchantService $merchantService;

    /**
     * @param string $name_client
     * @param string $cpf
     * @param string $description
     * @param float $amount
     * @param PaymentProvider $paymentProvider
     * @param PaymentRepository $paymentRepository
     * @param MerchantService $merchantService
     */
    public function __construct(
        string $name_client,
        string $cpf,
        string $description,
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

    /**
     * @param Payment $payment
     * @return \App\Models\Payment
     */
    public function pay(Payment $payment) : \App\Models\Payment
    {
        $rate = $this->calculateRate();
        $this->amount = $this->amount - $rate;
        $user = auth()->user();
        $paymentCreated = $this->paymentRepository->create($this->toArray($user->id));
        $this->paymentProvider->sendPayment($paymentCreated);
        $this->merchantService->updateMerchant($user->id, ['balance' => $user->balance + $paymentCreated->amount]);

        return $paymentCreated;
    }

    /**
     * @return float|int
     */
    public function calculateRate(): float|int
    {
        return $this->amount / 100 * RatePaymentMethod::BANK_SLIP;
    }

    /**
     * @return array
     */
    private function toArray(int $idMerchant) : array
    {
        return [
            'name_client' => $this->name_client,
            'cpf' => $this->cpf,
            'description' => $this->description,
            'amount' => $this->amount,
            'payment_method' => PaymentMethod::BANK_SLIP->value,
            'merchant_id' => $idMerchant
        ];
    }
}
