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

    public function getOne(int $idPayment)
    {
        return Payment::find($idPayment);
    }
}
