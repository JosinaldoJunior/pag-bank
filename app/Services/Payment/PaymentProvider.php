<?php

namespace App\Services\Payment;

use App\Enums\PaymentStatus;
use App\Repositories\Payment\PaymentRepository;
use Illuminate\Support\Facades\Log;

/**
 * @class PaymentProvider
 */
class PaymentProvider
{
    public function __construct(private readonly PaymentRepository $paymentRepository)
    {
    }

    /**
     * @return bool
     */
    private function simulationPaymentSuccessOrFails() : bool
    {
        $chance = rand(1, 100);

        if($chance <= 70) {
            return true;
        }

        return false;
    }

    /**
     * @param $data
     * @return void
     */
    public function sendPayment($payment): void
    {
        try {
            if (!$this->simulationPaymentSuccessOrFails()){
                throw new \Exception('error when making payment');
            }
            $this->paymentRepository->update($payment->id, ['status' => PaymentStatus::PAID->value]);
        } catch (\Exception $e) {
            $this->paymentRepository->update($payment->id, ['status' => PaymentStatus::FAILED->value]);
            Log::error($e->getMessage(), [
                json_encode($payment->toArray())
            ]);
            abort(response()->json(['message' => $e->getMessage()], 500));
        }
    }
}
