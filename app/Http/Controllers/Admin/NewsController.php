<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'News - Home';

        $news = News::latest()->paginate(5);
        $category = Category::all();

        return view('home.news.index', compact('title', 'news', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();

        $title = 'News - Create';
        return view('home.news.create', compact('title', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:50048',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        // Mengupload Gambar
        $image = $request->file('image');
        $image->storeAs('public/news', $image->hashName());

        News::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $image->hashName(),
            'content' => $request->content,
        ]);

        return redirect()->route('news.index')->with('success', 'Data berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'News - Show';

        $news = News::findOrFail($id);

        return view('home.news.show', compact('title', 'news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $category = Category::all();
        $title = 'News - Edit';

        return view('home.news.edit', compact('title', 'category', 'news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:50048'
        ]);

        $news = News::findOrFail($id);

        if ($request->file('image') == "") {
            $news->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'category_id' => $request->category_id,
                'content' => $request->content
            ]);
        } else {
            $news = News::FindOrFail($id);
            Storage::disk('local')->delete('public/news/' . basename($news->image));

            $image = $request->file('image');
            $image->storeAs('public/news', $image->hashName());

            $news->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'category_id' => $request->category_id,
                'image' => $image->hashName(),
                'content' => $request->content
            ]);
        };

        return redirect()->route('news.index')->with('succes', 'News berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);

        Storage::disk('local')->delete('public/news/' . basename($news->image));

        $news->delete();

        return redirect()->route('news.index');
    }
}
