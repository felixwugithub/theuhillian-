<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticlePDF;
use App\Models\Club;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stevebauman\Purify\Facades\Purify;
use Te7aHoudini\LaravelTrix\LaravelTrix;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

class ArticleController extends Controller
{
    public function show(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {


        $articles = Article::query()->where('published', true)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('magazine',[
            'articles' => $articles,

        ]);
    }

    public function create(){
        return view('magazine.editor');
    }

    public function display($title): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $article = Article::query()->where('title', str_replace('_', ' ', $title))->first();

        return view('article',[
            'article' => $article,
            'content' => Purify::clean($article->content)
        ]);
    }

    public function store($id, Request $request){

        $formfields = $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'content' => 'nullable',
            'pdf.*' => 'mimes:pdf|max:6969|nullable',

        ]);

        $article = Article::create([
            'title' => $formfields['title'],
            'club_id' => $id,
            'user_id' => \auth()->id(),
            'author' => $formfields['author'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'content' => Purify::clean($request['content'])
        ]);


        $article->save();

        if($request->hasFile('pdf')){
            $file = $request->file('pdf');
            $name = pathinfo($file, PATHINFO_FILENAME);
            $name = $name.'_'.time().'.'.'pdf';
            $path = $file->storeAs('public/articlePDFs', $name);

            ArticlePDF::create([
                'article_id' => $article->id,
                'pdf' => $name
            ]);
        }


        return redirect('/club-magazine-manager/'.$article->club->id);

    }

    public function update($article_id, Request $request){

        $formfields = $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'content' => 'nullable',
            'pdf.*' => 'mimes:pdf|max:6969|nullable',
        ]);

        $article = Article::find($article_id);

        $article->update([
            'title' => $formfields['title'],
            'user_id' => \auth()->id(),
            'author' => $formfields['author'],
            'updated_at' => Carbon::now(),
            'content' => Purify::clean($request['content'])
        ]);

        $article->save();

        if($request->hasFile('pdf')){
            $file = $request->file('pdf');
            $name = pathinfo($file, PATHINFO_FILENAME);
            $name = $name.'_'.time().'.'.'pdf';
            $path = $file->storeAs('public/articlePDFs', $name);

            if(isset($article->articlePDF)){
                $article->articlePDF->update([
                    'pdf' => $name
            ]);}else{
                ArticlePDF::create([
                    'article_id' => $article->id,
                    'pdf' => $name
                ]);
            }
        }

        if($request['removePDF'] === 'removePDFtrue'){
            $article->articlePDF->delete();
        }

        return redirect('/club-magazine-manager/'.$article->club->id);

    }



    public function manager($id){
        $club = Club::find($id);
        $articles = Article::query()->where('club_id', $id)->get();
        return view('magazine.manager', [
            'club' => $club,
            'articles' => $articles
        ]);
    }

    public function editor($id){
        $club = Club::find($id);
        return view('magazine.editor', [
            'club' => $club
        ]);
    }

    public function edit($id, $article_id){
        $club = Club::find($id);
        return view('magazine.editor', [
            'club' => $club,
            'article' => Article::find($article_id)
        ]);
    }

    public function publish($article_id){

        $article = Article::find($article_id);
        if(!$article->published){
        $article->update([
            'published' => true,
            'published_at' => Carbon::now()
        ]);}
        return redirect('/magazine');
    }

    public function fetch($id, Request $request){
        $club = Club::find($id);
        $results = Article::query()->where('club_id', $club->id)->where('published', true)->orderByDesc('published_at')->paginate(1, ['*'], 'articles');
        $club_articles = '';

        if ($request->ajax()) {
            foreach ($results as $result) {

                $club_articles.='<div class="mx-auto my-5 p-5 w-11/12 bg-blue-50 h-96"><p class="h-5 text-3x;">'.$result->title.'</p></div>';
            }
            return $club_articles;
        }

    }
}
