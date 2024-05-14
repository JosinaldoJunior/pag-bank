<?php

namespace Tests\Feature;

use App\Enums\PaymentMethod;
use App\Models\Merchant;
use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @class PaymentTest
 */
class PaymentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_get_all_payments_fails_unauthorized(): void
    {
        $response = $this->get('/api/payments');
        $response
            ->assertStatus(401)
            ->assertUnauthorized();
    }

    /**
     * @return void
     */
    public function test_get_all_payments_success(): void
    {
        $total = 10;
        $merchant = Merchant::factory(1)->create();
        Payment::factory($total)->create(['merchant_id' => $merchant->first()->id]);
        $token = JWTAuth::fromUser($merchant->first());
        $response = $this->get('/api/payments', ['Authorization' => "Bearer $token"]);
        $response->assertStatus(200);
        $this->assertTrue($response->json('meta')['total'] === $total);
    }

    /**
     * @return void
     */
    public function test_get_payment_fails_unauthorized(): void
    {
        $merchant = Merchant::factory(1)->create();
        $payment = Payment::factory(1)->create(['merchant_id' => $merchant->first()->id])->first();
        $response = $this->get("/api/payments/{$payment->id}");
        $response
            ->assertStatus(401)
            ->assertUnauthorized();
    }

    /**
     * @return void
     */
    public function test_get_payment_success(): void
    {
        $merchant = Merchant::factory(1)->create();
        $payment = Payment::factory(1)->create(['merchant_id' => $merchant->first()->id])->first();
        $token = JWTAuth::fromUser($merchant->first());
        $response = $this->get("/api/payments/{$payment->id}", ['Authorization' => "Bearer $token"]);
        $response->assertStatus(200);
        $this->assertTrue($response->json()['data']['id'] == $payment->id);
    }

    /**
     * @return void
     */
    public function test_create_payment_fails_unauthorized(): void
    {
        $response = $this->post("/api/payments", []);
        $response
            ->assertStatus(401)
            ->assertUnauthorized();
    }

    /**
     * @return void
     */
    public function test_create_payment_fails_without_body(): void
    {
        $merchant = Merchant::factory(1)->create();
        $token = JWTAuth::fromUser($merchant->first());
        $response = $this->post("/api/payments", [], ['Authorization' => "Bearer $token"]);
        $response->assertStatus(422);
    }

    /**
     * @return void
     */
    public function test_create_payment_success(): void
    {
        $merchant = Merchant::factory(1)->create();
        $token = JWTAuth::fromUser($merchant->first());
        $response = $this->post("/api/payments", [
                "name_client" => "TesteFeature",
                "cpf" => "04290064116",
                "description" => "teste feature",
                "amount" => 100,
                "payment_method" => PaymentMethod::PIX->value
            ],
            ['Authorization' => "Bearer $token"]);
        $response->assertStatus(201);
    }
}
