<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = ['pending', 'paid', 'expired', 'failed'];
        return [
            'id' => fake()->uuid,
            'name_client' => fake()->name(),
            'cpf' => fake()->creditCardNumber(),
            'description' => fake()->text(20),
            'amount' => fake()->randomFloat(2, 4, 2000),
            'status' => $status[rand(0, 3)],
            'payment_method' => 'pix',
            'paid_at' => fake()->dateTime()
        ];
    }
}
