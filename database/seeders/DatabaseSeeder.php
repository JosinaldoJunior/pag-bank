<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'teste@pagbank.com.br',
            'password' => 'secret',
        ]);

        Payment::factory(10)->create();
    }
}
