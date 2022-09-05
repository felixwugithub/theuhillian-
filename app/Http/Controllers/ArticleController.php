<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCoverImage;
use App\Models\ArticlePDF;
use App\Models\Club;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Stevebauman\Purify\Facades\Purify;
use Te7aHoudini\LaravelTrix\LaravelTrix;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

class ArticleController extends Controller
{
    public function show(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {


        $articles = Article::query()->where('published', true)
            ->orderByDesc('published_at')
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

        if($request->hasFile('cover')){
            $file = $request->file('cover');
            $name = pathinfo($file, PATHINFO_FILENAME);
            $name = $name.'_'.time().$file->getExtension();
            $path = $file->storeAs('public/articleCovers', $name);

            if(isset($article->articleCover)){
                $article->articleCover->update([
                    'image' => $name
                ]);}else{
                ArticleCoverImage::create([
                    'article_id' => $article->id,
                    'image' => $name
                ]);
            }
        }

        return redirect('/club-magazine-manager/'.$article->club->id);

    }

    public function update($article_id, Request $request){

        $formfields = $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'content' => 'nullable',
            'pdf.*' => 'mimes:pdf|max:6969|nullable',
            'cover' => 'nullable|image'
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
                unlink(storage_path('app/public/articlePDFs/'.$article->articlePDF->pdf));
                $article->articlePDF->update([
                    'pdf' => $name
            ]);}else{
                ArticlePDF::create([
                    'article_id' => $article->id,
                    'pdf' => $name
                ]);
            }
        }

        if($request->hasFile('cover')){
            $file = $request->file('cover');
            $name = pathinfo($file, PATHINFO_FILENAME);
            $name = $name.'_'.time().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('public/articleCovers', $name);

            if(isset($article->articleCover)){
               unlink(storage_path('app/public/articleCovers/'.$article->cover->image));
                $article->cover->update([
                    'image' => $name
                ]);}else{
                $article->cover()->create([
                    'article_id' => $article->id,
                    'image' => $name
                ]);
            }
        }

        if($request['removePDF'] === 'removePDFtrue'){
            unlink(storage_path('app/public/articlePDFs/'.$article->articlePDF->pdf));
            $article->articlePDF->delete();
        }

        if($request['removeCover'] === 'removeCovertrue'){

            unlink(storage_path('app/public/articleCovers/'.$article->cover->image));
            $article->cover->delete();
        }

        return redirect('/club-magazine-editor/'.$article->club->id.'/'.$article->id);
    }


    public function magazine_manager($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $club = Club::find($id);
        $articles = Article::query()->where('club_id', $id)->get();
        return view('magazine.manager', [
            'club' => $club,
            'articles' => $articles
        ]);
    }

    public function editor($id): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $club = Club::find($id);
        $article = $club->articles()->create([
            'title' => 'Untitled'.uniqid(),
            'author' => 'Unknown'
        ]);

        return redirect('/club-magazine-editor/'.$club->id.'/'.$article->id);
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
            foreach ($results as $article) {
                $club_articles.= view('club-components.article', compact('article'))->render();
            }
            return $club_articles;
        }

    }
}
