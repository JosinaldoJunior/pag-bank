<?php

namespace Tests\Feature;

use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @class AuthTest
 */
class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_login_failed(): void
    {
        $response = $this->post('/api/auth/login', []);
        $response->assertStatus(401);
    }

    /**
     * @return void
     */
    public function test_login_success(): void
    {
        $params = [
            'email' => 'teste@teste.com',
            'password' => 'teste123'
        ];
        Merchant::factory($params)->create();
        $response = $this->post('/api/auth/login', $params);
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_me_success(): void
    {
        $params = [
            'email' => 'teste@teste.com',
            'password' => 'teste123'
        ];
        $merchant = Merchant::factory($params)->create();
        $token = JWTAuth::fromUser($merchant->first());
        $response = $this->post('/api/auth/me', [], ['Authorization' => "Bearer $token"]);
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_me_failed(): void
    {
        $response = $this->post('/api/auth/me', [], []);
        $response->assertStatus(401);
    }

    /**
     * @return void
     */
    public function test_logout_failed(): void
    {
        $response = $this->post('/api/auth/logout', [], []);
        $response->assertStatus(401);
    }

    /**
     * @return void
     */
    public function test_logout_success(): void
    {
        $params = [
            'email' => 'teste@teste.com',
            'password' => 'teste123'
        ];
        $merchant = Merchant::factory($params)->create();
        $token = JWTAuth::fromUser($merchant->first());
        $response = $this->post('/api/auth/logout', [], ['Authorization' => "Bearer $token"]);
        $response->assertStatus(200);
    }
}
