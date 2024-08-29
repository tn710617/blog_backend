<?php

namespace Feature\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_can_index_categories()
    {
        $this->getJson(route('v1.categories.index'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'category_name',
                    ]
                ]
            ]);
    }
}
