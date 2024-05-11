<?php

namespace App\Services\Payment;

use App\Enums\PaymentMethod;
use App\Enums\RatePaymentMethod;
use App\Events\PaymentPixProcessed;
use App\Models\Payment as PaymentAlias;
use App\Repositories\Payment\IPaymentRepository;
use App\Services\Merchant\IMerchantService;
use App\Services\Merchant\MerchantService;
use Illuminate\Support\Facades\Auth;

/**
 * @class PaymentPix
 */
class PaymentPix implements IPayment
{

    public function __construct(
        protected string $name_client,
        protected string $cpf,
        protected string $description,
        protected float $amount,
        private IPaymentRepository $paymentRepository,
        private PaymentProvider $paymentProvider,
        private IMerchantService $merchantService,
    ) { }

    /**
     * @param array $data
     * @return void
     */
    public function makePayment() : array
    {
        try {
            $rate = $this->calculateRate();
            $this->amount = $this->amount - $rate;

            $user = auth()->user();
            $this->paymentProvider->sendPayment($this->toArray());
            $payment = $this->paymentRepository->create($this->toArray());
            $this->merchantService->updateMerchant($user->id, ['balance' => $user->balance + $payment->amount]);

            return $payment->toArray();
        } catch (\Exception $e) {
            abort(response()->json(['message' => 'error when making payment'], 500));
        }

    }

    /**
     * @param float $amount
     * @return float
     */
    public function calculateRate() : float
    {
        return $this->amount / 100 * RatePaymentMethod::PIX;
    }

    private function toArray() : array
    {
        return [
            'name_client' => $this->name_client,
            'cpf' => $this->cpf,
            'description' => $this->description,
            'amount' => $this->amount,
            'payment_method' => PaymentMethod::PIX
        ];
    }
}
