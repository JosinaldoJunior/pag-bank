<?php

namespace App\Services\Payment;

use App\Repositories\Payment\IPaymentRepository;

/**
 *
 */
class PaymentService implements IPaymentService
{
    /**
     * @param IPaymentRepository $paymentRepository
     */
    public function __construct(private IPaymentRepository $paymentRepository)
    {
    }

    /**
     * @return mixed
     */
    public function getAllPayments()
    {
        return $this->paymentRepository->getAll();
    }

    /**
     * @param int $idPayment
     * @return mixed
     */
    public function getOnePayment(int $idPayment)
    {
        return $this->paymentRepository->getOne($idPayment);
    }
}
