<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['pix', 'bank_slip', 'bank_transfer'];
        $type = $types[rand(0, 2)];

        return [
            'name' => $type,
            'slug' => Str::slug($type),
            'discount_percentage' => 1.5
        ];
    }
}
