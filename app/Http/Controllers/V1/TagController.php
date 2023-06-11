<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TagCollection;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index()
    {
        return TagCollection::make(Tag::orderByDesc('used_at')->get());
    }

    public function indexPopularly()
    {
        return TagCollection::make(Tag::ofPopular()->take(10)->get());
    }
}
