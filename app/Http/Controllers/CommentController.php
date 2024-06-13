<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CommentController extends Controller
{

    // public function index()
    // {
    //     return Inertia::render('Comment/index', [
    //         'comments' => Comment::all(),
    //     ]);


    // }


    public function store(Article $article, Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->description = $request->comment;
        $comment->article_id = $article->id;
        $comment->save();

        return back()->with("success","Kommentaar lisatud.");

    }

    public function destroy(Comment $comment)
    {
        if (Auth::check() && Auth::user()->usertype == 'admin') {
            $comment->delete();
            return back()->with('success', 'Kommentaar kustutatud.');
        } elseif(Auth::check() && Auth::user()->usertype == 'user') {
            return back()->with('success', 'Sul ei ole piisavalt oiguseid');    
        }
        return false;


    }
}