<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    private $category;

    public Function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index($slug)
    {
        $category = $this->category->whereSlug($slug)->first();

        return view('category', compact('category'));
    }
}
