<?php

namespace Database\Seeders\V1;

use App\Models\Tag;
use App\Traits\DefaultSeederTrait;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{

    use DefaultSeederTrait;

    public function __construct()
    {
        $this->setDefinedData();
    }

    protected $excludedColumns = [
        'used_at'
    ];
    protected $model = Tag::class;
    protected $uniqueKey = ['id'];
    protected $timestamps = false;
    protected $cacheKeys = [];
    protected $definedData;


    public function setDefinedData()
    {
        $this->definedData = [
            [
                'id' => 1,
                'tag_name' => 'Laravel',
            ],
            [
                'id' => 2,
                'tag_name' => 'Backend',
            ],
            [
                'id' => 3,
                'tag_name' => 'Frontend',
            ],
            [
                'id' => 4,
                'tag_name' => 'DevOps',
            ],
            [
                'id' => 5,
                'tag_name' => 'Node.js',
            ],
            [
                'id' => 6,
                'tag_name' => 'React.js',
            ],
            [
                'id' => 7,
                'tag_name' => 'HTML',
            ],
            [
                'id' => 8,
                'tag_name' => 'CSS',
            ],
            [
                'id' => 9,
                'tag_name' => 'Tailwind CSS',
            ],
            [
                'id' => 10,
                'tag_name' => 'PHP',
            ],
            [
                'id' => 11,
                'tag_name' => 'MySQL',
            ],
            [
                'id' => 12,
                'tag_name' => 'CSV',
            ],
        ];
    }


}
