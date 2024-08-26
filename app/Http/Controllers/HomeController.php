<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $articles = Article::latest()->paginate(6);

        return view('index', [
            'tags' => $tags,
            'categories' => $categories,
            'articles' => $articles
        ]);
    }
}
