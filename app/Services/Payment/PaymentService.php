<?php

namespace App\Services\Payment;

use App\Repositories\Payment\IPaymentRepository;
use App\Services\Merchant\IMerchantService;

/**
 * @class PaymentService
 */
class PaymentService implements IPaymentService
{
    /**
     * @param IPaymentRepository $paymentRepository
     */
    public function __construct(private IPaymentRepository $paymentRepository,
        private PaymentProvider $paymentProvider,
        private IMerchantService $merchantService
    )
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
    public function getOnePayment(string $idPayment)
    {
        return $this->paymentRepository->getOne($idPayment);
    }

    public function pay(array $dataPayment)
    {
//        dd('Service|$dataPayment', $dataPayment);

        $paymentType = new PaymentPix($dataPayment['name_client'], $dataPayment['cpf'], $dataPayment['description'],$dataPayment['amount'], $this->paymentRepository,
            $this->paymentProvider,
            $this->merchantService
        );
//        $paymentType = new PaymentBankTransfer($dataPayment['name_client'], $dataPayment['cpf'], $dataPayment['description'],$dataPayment['amount']);
//        $paymentType = new PaymentBankSlip($dataPayment['name_client'], $dataPayment['cpf'], $dataPayment['description'],$dataPayment['amount']);

        $payment = new Payment();
        $result = $payment->makePay($paymentType);
//        $payment->makePay($paymentType);
        return $result;
    }
}
