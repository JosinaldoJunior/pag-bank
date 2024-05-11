<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Services\Payment\IPaymentService;
use Illuminate\Http\Request;

/**
 *
 */
class PaymentController extends Controller
{
    /**
     * @param IPaymentService $IPaymentService
     */
    public function __construct(protected IPaymentService $IPaymentService)
    {
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $payments = $this->IPaymentService->getAllPayments();
        return PaymentResource::collection($payments);
    }


    /**
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        dd('store payment not implemented');
    }

    public function show(string $idPayment)
    {
        $payment = $this->IPaymentService->getOnePayment($idPayment);
        if (!$payment) return response()->json([], 404);
        return new PaymentResource($payment);
    }
}
