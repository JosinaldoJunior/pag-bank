<?php

namespace App\Repositories\Payment;

use App\Models\Payment;

/**
 * @class PaymentRepository
 */
class PaymentRepository implements IPaymentRepository
{

    /**
     * @return mixed
     */
    public function getAll()
    {
        return Payment::paginate(10);
    }

    /**
     * @param string $idPayment
     * @return mixed
     */
    public function getOne(string $idPayment)
    {
        return Payment::find($idPayment);
    }
}
