<?php

namespace App\Repositories\Merchant;

use App\Models\Merchant;

/**
 * @class PaymentRepository
 */
class MerchantRepository implements IMerchantRepository
{

    /**
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $merchant = $this->getOne($id);
        $merchant->fill($data);

        return $merchant->save();
    }

    /**
     * @param string $idMerchant
     * @return mixed
     */
    public function getOne(string $idMerchant)
    {
        return Merchant::find($idMerchant);
    }
}
