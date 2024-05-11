<?php

namespace App\Services\Merchant;

interface IMerchantService
{
    public function updateMerchant(int $idMerchant, array $dataMerchant);
}
