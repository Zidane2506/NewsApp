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

        $sliderNews = News::latest()->limit(3)->get();

        return view('frontend.news.index', compact('category', 'sliderNews'));
    }

    public function detailNews($slug) 
    {
        $category = Category::latest()->get();

        $news = News::where('slug', $slug)->first();

        return view('frontend.news.detail', compact('category', 'news'));
    }

    public function detailCategory($slug) 
    {
        $category = Category::latest()->get();

        $detailCategory = Category::where('slug', $slug)->first();

        $news = News::where('category_id', $detailCategory)->latest()->get();

        return view('frontend.News.detailCategory', compact('category', 'detailCategory', 'news'));
    }

}
