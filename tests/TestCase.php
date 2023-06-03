<?php

namespace Tests;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Http;

abstract class TestCase extends BaseTestCase
{
    const TEST_ETH_PRIVATE_KEY = '0x97cd54c98153e5697f27dcf848b6c4b8ac1bc6b93b4ac857f1ae29f296c3d70a';
    const TEST_ETH_PUBLIC_KEY = '0x025aad291f94b9b5f2a63ab69956e9fd4945605098dfa5348d07bfeca83e4e6b87';
    const TEST_ETH_ADDRESS = '0x091403514972a6f535aA019A97097d5669Aed2cB';


    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        Http::preventStrayRequests();
    }

    protected function actingAsUser(array $userAttributes = [])
    {
        $user = User::factory()->create($userAttributes);
        $this->actingAs($user, 'sanctum');
    }

}
