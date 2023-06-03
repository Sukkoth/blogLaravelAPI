<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogStoreRequest;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class BlogController extends Controller
{
    public function index(Request $request)
    {


        $blogs = QueryBuilder::for (Blog::class)->whereHas('category')
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('category.name'),
            ])
            ->paginate(6);

        return response()->json([
            "blogs" => $blogs->items(),
            "pagination" => [
                "current_page" => $blogs->currentPage(),
                "last_page" => $blogs->lastPage(),
                "per_page" => $blogs->perPage(),
                "total" => $blogs->total(),
                "path" => $blogs->path()
            ],
        ]);
    }

    public function view($blogId)
    {
        $blog = Blog::where('id', $blogId)->with(['author', 'category'])->first();
        return response()->json([
            'blog' => $blog,
        ], 200);
    }

    public function suggestions(Request $request)
    {
        $limit = (int) $request->query('limit') ?: 5;
        $blogs = Blog::inRandomOrder()->limit($limit)->get();
        return response()->json([
            "blogs" => $blogs,
            "limit" => (int) $request->query('limit') ?: 5
        ], 200);
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
            "blog" => $blog,
        ]);
    }

    public function delete(Blog $blog)
    {
        return response()->json([
            "blog" => $blog
        ]);

    }

}