<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticlePDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Te7aHoudini\LaravelTrix\LaravelTrix;

class ArticleController extends Controller
{
    public function show(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {


        $articles = Article::query()
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('magazine',[
            'articles' => $articles
        ]);
    }

    public function create(){
        return view('magazine.editor');
    }

    public function display($title): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $article = Article::query()->where('title', str_replace('_', ' ', $title))->first();

        return view('article',[
            'article' => $article
        ]);
    }

    public function store(Request $request){

        $formfields = $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'content' => 'nullable',
            'pdf.*' => 'mimes:pdf|max:100000|nullable',

        ]);

        $article = Article::create([
            'title' => $formfields['title'],
            'author' => $formfields['author'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'content' => $request['content']
        ]);

        $article->save();



        if($request->hasFile('pdf')){
            $file = $request->file('pdf');
            $name = pathinfo($file, PATHINFO_FILENAME);
            $name = $name.'_'.time().'.'.$file->extension();
            $path = $file->storeAs('public/articlePDFs', $name);

            ArticlePDF::create([
                'article_id' => $article->id,
                'pdf' => $name
            ]);
        }

        return redirect('/magazine');












    }


}
