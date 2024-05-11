<?php

namespace App\Services\Merchant;

use App\Repositories\Merchant\IMerchantRepository;
use App\Repositories\Payment\IPaymentRepository;
use App\Services\Payment\IPaymentService;


/**
 * @class PaymentService
 */
class MerchantService implements IMerchantService
{

    /**
     * @param IMerchantRepository $merchantRepository
     */
    public function __construct(private IMerchantRepository $merchantRepository) {}

    /**
     * @param int $idMerchant
     * @param array $data
     * @return mixed
     */
    public function updateMerchant(int $idMerchant, array $data)
    {
        return $this->merchantRepository->update($idMerchant, $data);
    }
}
