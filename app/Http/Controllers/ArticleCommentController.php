<?php

namespace App\Http\Controllers;

use App\Mail\Welcome;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class ArticleCommentController extends Controller
{
    public function store($id, Request $request){

        $data = $request->validate([
            'content' => 'required|min:2|max:1024'
        ]);

        $article = Article::find($id);
        $article->comments()->create([
            'content' => $data['content'],
            'article_id' => $id,
            'user_id' => \auth()->id()
        ]);

        return back()->with([
            'commented' => true
        ]);
    }

    public function fetch($id, Request $request){
        $article = Article::find($id);
        $results = ArticleComment::query()->where('article_id', $article->id)->orderByDesc('created_at')->paginate(1, ['*'], 'comments');
        $article_comments = '';

        if ($request->ajax()) {
            foreach ($results as $comment) {
                $article_comments.= view('magazine-components.comment', compact('comment'))->render();
            }
            return $article_comments;
        }

    }

    public function like($id){
        $comment = ArticleComment::find($id);
        $article = $comment->article;
        $comments = ArticleComment::query()->where('article_id', $article->id)->orderByDesc('created_at')->get();
        $response = auth()->user()->toggleLike($comment);

        $pos = 1;
        foreach ($comments as $c){
            if ($comment->id == $c->id){
                break;
            }
            $pos = $pos + 1;
        }

        Mail::to(Auth::user())->send(new Welcome(Auth::user()));


        return back()->with([
            'liked-article-comment' => 'c'.$id,
            'comment-pos' => $pos
        ]);
    }
}
