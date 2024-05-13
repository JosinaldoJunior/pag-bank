<?php

namespace App\Services\Payment;

use App\Enums\PaymentMethod;
use App\Factories\BankSlipPay;
use App\Factories\BankTransferPay;
use App\Factories\Payment;
use App\Factories\PixPay;
use App\Repositories\Merchant\MerchantRepository;
use App\Repositories\Payment\IPaymentRepository;
use App\Repositories\Payment\PaymentRepository;
use App\Services\Merchant\MerchantService;

/**
 * @class PaymentService
 */
class PaymentService implements IPaymentService
{
    /**
     * @param IPaymentRepository $paymentRepository
     */
    public function __construct(private readonly IPaymentRepository $paymentRepository){}

    /**
     * @return mixed
     */
    public function getAllPayments()
    {
        return $this->paymentRepository->getAll();
    }

    /**
     * @param string $idPayment
     * @return mixed
     */
    public function getOnePayment(string $idPayment): mixed
    {
        return $this->paymentRepository->getOne($idPayment);
    }

    /**
     * @param array $dataPayment
     * @return \App\Models\Payment
     * @throws \Exception
     */
    public function handlePayment(array $dataPayment) : \App\Models\Payment
    {
        switch ($dataPayment['payment_method']) {
            case PaymentMethod::PIX->value:
                $payment = $this->makePayment(
                    new PixPay($dataPayment['name_client'], $dataPayment['cpf'], $dataPayment['description'],$dataPayment['amount'], new PaymentProvider(), new PaymentRepository(), new MerchantService(new MerchantRepository()))
                );
                break;

            case PaymentMethod::BANK_SLIP->value:
                $payment = $this->makePayment(
                    new BankSlipPay($dataPayment['name_client'], $dataPayment['cpf'], $dataPayment['description'],$dataPayment['amount'], new PaymentProvider(), new PaymentRepository(), new MerchantService(new MerchantRepository()))
                );
                break;

            case PaymentMethod::BANK_TRANSFER->value:
                $payment = $this->makePayment(
                    new BankTransferPay($dataPayment['name_client'], $dataPayment['cpf'], $dataPayment['description'],$dataPayment['amount'], new PaymentProvider(), new PaymentRepository(), new MerchantService(new MerchantRepository()))
                );
                break;

            default:
                throw new \Exception('Payment method is invalid.',  422);
        }

        return $payment;
    }

    /**
     * @param Payment $payment
     * @return \App\Models\Payment
     */
    function makePayment(Payment $payment): \App\Models\Payment
    {
        return $payment->pay($payment);
    }
}
