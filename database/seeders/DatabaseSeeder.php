<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Merchant;
use App\Models\Payment;
use App\Models\User;
use Database\Factories\PaymentFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Merchant::factory(9)->create(['password' => 'secret']);
        Merchant::factory()->create([
            'name' => 'MerchantTest',
            'email' => 'teste@pagbank.com.br',
            'password' => 'secret',
            'balance' => 499.99
        ]);

        Payment::factory(20)->create();
    }
}
