<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Services\Payment\IPaymentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @param StorePaymentRequest $request
     * @return PaymentResource|\Illuminate\Http\JsonResponse
     */
    public function store(StorePaymentRequest $request)
    {
        try {
            $payment = $this->IPaymentService->handlePayment($request->all());
            return new PaymentResource($payment);
        } catch (\Exception $e) {
            return response()
                ->json(
                    ['message' => 'error when making payment'],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
    }

    /**
     * @param string $idPayment
     * @return PaymentResource|\Illuminate\Http\JsonResponse
     */
    public function show(string $idPayment)
    {
        $payment = $this->IPaymentService->getOnePayment($idPayment);
        if (!$payment) return response()->json([], 404);
        return new PaymentResource($payment);
    }
}
