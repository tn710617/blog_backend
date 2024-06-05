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
        $this->withoutExceptionHandling();

        $expectation = [
            'wallet_address' => Str::random()
        ];

        $response = $this->getJson(route('v1.user.auth.get-to-be-signed-message', [
            'wallet_address' => $expectation['wallet_address']
        ]));

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                'to_be_signed_message'
            ]
        ]);

        $this->assertDatabaseHas('wallet_to_be_signed_messages', [
            'wallet_address' => $expectation['wallet_address']
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
        $expectation = [
            'wallet_address' => Str::random(42)
        ];

        $message = $this->get(route('v1.user.auth.get-to-be-signed-message', [
            'wallet_address' => $expectation['wallet_address']
        ]))->json('data.to_be_signed_message');

        Config::set('custom.admin_wallet_addresses', [$expectation['wallet_address']]);
        $this->postJson(route('v1.user.auth.login.metamask'), [
            'address' => self::TEST_ETH_ADDRESS,
            'signature' => app(Web3Service::class)->signMessage($message, self::TEST_ETH_PRIVATE_KEY)
        ])->assertUnauthorized();
    }

    public function test_an_user_can_login()
    {
        $message = $this->get(route('v1.user.auth.get-to-be-signed-message', [
            'wallet_address' => self::TEST_ETH_ADDRESS
        ]))->json('data.to_be_signed_message');

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
