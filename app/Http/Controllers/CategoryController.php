<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('status', true)->get();
        return response()->json([
            'categories' => $categories
        ], 200);
    }

    public function getBlogs($category)
    {
        $blogs = QueryBuilder::for (Blog::class)->whereHas('category', function (Builder $query) use ($category) {
            $query->where('name', $category);
        })->paginate(6);


        return response()->json([
            "blogs" => $blogs->items(),
            "pagination" => [
                "current_page" => $blogs->currentPage(),
                "last_page" => $blogs->lastPage(),
                "per_page" => $blogs->perPage(),
                "total" => $blogs->total(),
                "path" => $blogs->path()
            ],

        ], 200);
    }
}