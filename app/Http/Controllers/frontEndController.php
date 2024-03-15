<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;

class frontEndController extends Controller
{
    public function index()
    {
        $category = Category::latest()->get();

        $categoryNews = News::with('category')->latest()->get();

        return view('frontEnd.news.index', compact('category', 'categoryNews'));
    }

}
