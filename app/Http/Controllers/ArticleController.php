<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $articles = Article::with('user')->paginate(10);

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
        $tags = Tag::all();
        return view('articles.create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Article $article)
    {
        $attributes = request()->validate([
            'title' => ['required', 'min:5'],
            'content' => ['required', 'min:15'],
            'category' => ['required']
        ]);

        $article = Article::create([
            'title' => $attributes['title'],
            'content' => $attributes['content'],
            'category_id' => $attributes['category'],
            'user_id' => auth()->id()
        ]);

        $tagIds = request()->input('tags', []);
        $article->tags()->attach($tagIds);


        if (request()->hasFile('photo')) {
            $photo = request()->file('photo')->getClientOriginalName();
            request()->file('photo')->storeAs('articles/' . $article->id, $photo, 'public');

            $article->update(['photo' => $photo]);
        }


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
        $tags = Tag::all();
        $selectedTags = $article->tags->pluck('id')->toArray();

        return view('articles.edit', [
            'article' => $article,
            'categories' => $categories,
            'selectedTags' => $selectedTags,
            'tags' => $tags
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

        $tagIds = request()->input('tags', []);
        $article->tags()->syncWithoutDetaching($tagIds);;


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
