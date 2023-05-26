<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}