<?php

namespace Tests\Feature\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_can_index_popularly()
    {
        $this->getJson(route('v1.tags.index.popularly'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'tag_name',
                    ],
                ],
            ]);
    }

    public function test_can_index()
    {
        $this->getJson(route('v1.tags.index'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'tag_name',
                    ],
                ],
            ]);
    }
}
