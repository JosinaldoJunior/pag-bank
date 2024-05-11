<?php

namespace App\Enums;

enum PaymentMethod : string
{
    case PIX = 'pix';
    case BANK_SLIP = 'bank_slip';
    case BANK_TRANSFER = 'bank_transfer';
}
