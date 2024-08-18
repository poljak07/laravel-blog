<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->simplePaginate(10);

        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = category::all();
        return view('articles.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Article $article)
    {
        request()->validate([
            'title' => ['required', 'min:5'],
            'content' => ['required', 'min:15']
        ]);

        Article::create([
            'title' => request('title'),
            'content' => request('content'),
            'category_id' => request('category'),
        ]);

        return redirect('/articles/' . $article->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show',
            [
                'article' => $article
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = category::all();

        return view('articles.edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        request()->validate([
           'title' => ['required', 'min:3'],
           'content' => ['required', 'min:5'],
        ]);

        $article->update([
            'title' => request('title'),
            'content' => request('content')
        ]);

        return redirect('/articles/' . $article->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect('/articles');
    }
}
