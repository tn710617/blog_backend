<?php

namespace Tests\Feature\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagControllerTest extends TestCase
{

    use RefreshDatabase;

    public function testIndex()
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
