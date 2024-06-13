<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $articles = Article::all();
        // return Inertia::render('Article/Index', ['articles' => $articles]);
        return Inertia::render('Article/Index', [
            'articles' => Article::with('comments.user')->get(),
        ]); 


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Article/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Article::create($request->validate([
            'description' => 'required',
            'title' => 'required',
        ]));

        return redirect()->route('articles.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return Inertia::render('Article/Edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $article->update([
            'description' => $request->description,
            'title' => $request->title,
        ]);

        return redirect()->route (route: 'articles.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article, Comment $comment)
    {
        $article->delete();
        return back()->with('success', 'Artikkel kustutatud.');

    }
}