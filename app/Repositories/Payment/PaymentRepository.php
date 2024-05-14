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

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return Payment::create($data);
    }

    /**
     * @return mixed
     */
    public function update(string $id, array $data)
    {
        $payment = $this->getOne($id);
        $payment->fill($data);

        return $payment->save();
    }
}
