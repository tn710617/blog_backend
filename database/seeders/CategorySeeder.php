<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Traits\DefaultSeederTrait;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    use DefaultSeederTrait;

    public function __construct()
    {
        $this->setDefinedData();
    }

    protected $excludedColumns = [];
    protected $model = Category::class;
    protected $uniqueKey = ['id'];
    protected $timestamps = false;
    protected $cacheKeys = [];
    protected $definedData;


    public function setDefinedData()
    {
        $this->definedData = [
            [
                'id' => 1,
                'category_name' => '程式技術',
            ],
            [
                'id' => 2,
                'category_name' => '生活日記',
            ],
        ];
    }
}
