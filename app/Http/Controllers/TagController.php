<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();

        return view('tags.index', [
            'tags' => $tags
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $tags = Tag::all();

        return view('tags.create', [
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Tag $tags)
    {
        request()->validate([
           'name' => ['required', 'unique:tags', 'min:3']
        ]);

        Tag::create([
            'name' => request('name')
        ]);

        $tags = Tag::all();

        return view('tags.create', [
            'tags' => $tags
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('tags.show',
        [
            'tag' => $tag
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', [
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        request()->validate([
            'name' => ['required', 'unique:tags', 'min:3']
        ]);

        $tag->update([
            'name' => request('name')
        ]);

        return redirect('tags/create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect('/tags/create');
    }
}
