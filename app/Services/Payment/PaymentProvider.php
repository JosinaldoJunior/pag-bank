<?php

namespace App\Services\Payment;

use Illuminate\Support\Facades\Log;

/**
 *
 */
class PaymentProvider
{
    /**
     *
     */
    public function __construct()
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
    public function sendPayment($data)
    {
        try {
            if (!$this->simulationPaymentSuccessOrFails()){
                throw new \Exception('error when making payment');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage(), [
                json_encode($data)
            ]);
            abort(response()->json(['message' => $e->getMessage()], 500));
        }
    }
}
