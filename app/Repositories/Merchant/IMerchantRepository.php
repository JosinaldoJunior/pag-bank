<?php

namespace App\Repositories\Merchant;

interface IMerchantRepository
{
    public function getOne(string $idMerchant);
    public function update(int $idMerchant, array $data);
}
