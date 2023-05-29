<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogStoreRequest;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class BlogController extends Controller
{
    public function index(Request $request)
    {

        $blogs = QueryBuilder::for (Blog::class)
            ->paginate(8);
        // $blogs = Blog::limit((int) $request->query('limit') ?: null)->with(['category:id,name', 'author:id,user_name,first_name,last_name,avatar'])->get();
        return response()->json([
            'here' => 'why',
            "blogs" => $blogs
        ]);
    }

    public function store(BlogStoreRequest $request)
    {
        $blog = Blog::create([
            "title" => $request->input('title'),
            "sub_title" => $request->input('sub_title'),
            "body" => $request->input('body'),
            "category_id" => $request->input('category_id'),
            "user_id" => Auth::user()->id,
        ]);

        return response()->json([
            "message" => "Blog created",
            "blog" => $blog
        ]);
    }

    public function update(Blog $blog)
    {
        return response()->json([
            "blog" => $blog
        ]);
    }

    public function delete(Blog $blog)
    {
        return response()->json([
            "blog" => $blog
        ]);

    }

}
