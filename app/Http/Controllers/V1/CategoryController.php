<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategoryCollection;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        return CategoryCollection::make(Category::all());
    }
}
