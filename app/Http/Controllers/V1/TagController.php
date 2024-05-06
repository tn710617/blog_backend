<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TagCollection;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{

    public function index(Request $request)
    {
        $builder = Tag::query();

        if (!$request->user()) {
            $builder = $builder->where('is_private', false);
        }


        return TagCollection::make($builder->orderByDesc('used_count')->orderBy('tag_name')->get());
    }

    public function indexPopularly()
    {
        return TagCollection::make(Tag::ofPopular()->take(10)->get());
    }
}
