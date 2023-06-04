<?php

namespace Tests\Feature\V1;

use App\Models\User;
use App\Services\Web3Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_can_get_to_be_signed_message()
    {
        $response = $this->getJson(route('v1.user.auth.get-to-be-signed-message'));

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'to_be_signed_message'
            ]
        ]);
    }

    public function test_can_get_is_logged_in()
    {
        $response = $this->getJson(route('v1.user.auth.is-logged-in'));

        $response->assertUnauthorized();

        $this->actingAs(User::factory()->create(), 'sanctum');

        $response = $this->getJson(route('v1.user.auth.is-logged-in'));

        $response->assertNoContent();
    }

    public function test_only_user_with_admin_wallet_address_can_login()
    {
        $message = $this->get(route('v1.user.auth.get-to-be-signed-message'))->json('data.to_be_signed_message');

        Config::set('custom.admin_wallet_addresses', [Str::random(42)]);
        $this->postJson(route('v1.user.auth.login.metamask'), [
            'address' => self::TEST_ETH_ADDRESS,
            'signature' => app(Web3Service::class)->signMessage($message, self::TEST_ETH_PRIVATE_KEY)
        ])->assertUnauthorized();
    }

    public function test_a_user_can_login()
    {
        $message = $this->get(route('v1.user.auth.get-to-be-signed-message'))->json('data.to_be_signed_message');

        Config::set('custom.admin_wallet_addresses', [self::TEST_ETH_ADDRESS]);
        $this->postJson(route('v1.user.auth.login.metamask'), [
            'address' => self::TEST_ETH_ADDRESS,
            'signature' => app(Web3Service::class)->signMessage($message, self::TEST_ETH_PRIVATE_KEY)
        ])->assertNoContent();
    }

    public function test_a_user_can_logout()
    {
        $this->actingAs(User::factory()->create(), 'sanctum');

        $this->postJson(route('v1.user.auth.logout'))->assertNoContent();
    }

    public function test_only_correct_signature_could_log_in()
    {
        $this->postJson(route('v1.user.auth.login.metamask'), [
            'address' => self::TEST_ETH_ADDRESS,
            'signature' => Str::random()
        ])->assertUnauthorized();
    }


}
