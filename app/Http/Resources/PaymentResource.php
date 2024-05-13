<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name_client' => $this->name_client,
            'cpf' => $this->cpf,
            'description' => $this->description,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
            'merchant' => [
                'id' => $this->merchant->id,
                'name' => $this->merchant->name
            ],
            'paid_at' => $this->paid_at
        ];
    }
}
