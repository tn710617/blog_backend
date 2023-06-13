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
            [
                'id' => 13,
                'tag_name' => 'Git',
            ],
            [
                'id' => 14,
                'tag_name' => 'Apache',
            ],
            [
                'id' => 15,
                'tag_name' => 'Blockchain',
            ],
            [
                'id' => 16,
                'tag_name' => 'GitLab Runner',
            ],
            [
                'id' => 17,
                'tag_name' => 'CI/CD',
            ],
            [
                'id' => 18,
                'tag_name' => 'Payment Gateway',
            ],
            [
                'id' => 19,
                'tag_name' => 'Facebook',
            ],
            [
                'id' => 20,
                'tag_name' => 'Google Analytics',
            ],
            [
                'id' => 21,
                'tag_name' => 'AWS',
            ],
            [
                'id' => 22,
                'tag_name' => 'Infrastructure',
            ],
            [
                'id' => 23,
                'tag_name' => 'Jenkins',
            ],
            [
                'id' => 24,
                'tag_name' => 'GitHub',
            ],
            [
                'id' => 25,
                'tag_name' => 'Kubernetes',
            ],
            [
                'id' => 26,
                'tag_name' => 'GKE',
            ],
            [
                'id' => 27,
                'tag_name' => 'Geth',
            ],
            [
                'id' => 28,
                'tag_name' => 'Prysm',
            ],
            [
                'id' => 29,
                'tag_name' => 'Blockchain Node',
            ],
        ];
    }


}
