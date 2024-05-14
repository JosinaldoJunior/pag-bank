<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name_client',
        'cpf',
        'description',
        'amount',
        'payment_method',
        'merchant_id',
        'status'
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
            $model->paid_at = Date::now();
        });
    }

    public function merchant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }
}
