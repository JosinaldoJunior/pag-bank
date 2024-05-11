<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Merchant;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $types = ['Pix', 'Bank Slip', 'Bank Transfer'];
        $percentage = [1.5, 2, 4];
        foreach ($types as $key => $type) {
            PaymentMethod::factory()->create([
                'name' => $type,
                'slug' => Str::slug($type),
                'discount_percentage' => $percentage[$key]
            ]);
        }

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
