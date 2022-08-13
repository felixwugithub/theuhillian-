<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticlePDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function show(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('magazine',[
            'articles' => Article::paginate(4)
        ]);
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
            'content' => 'required',
            'pdf.*' => 'mimes:pdf|max:100000|nullable',

        ]);

        $article = Article::create([
            'title' => $formfields['title'],
            'content' => $formfields['content'],
            'author' => $formfields['author'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

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
        }else{
            return "no file";
        }

        return redirect('/magazine');












    }


}
