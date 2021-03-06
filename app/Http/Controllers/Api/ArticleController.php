<?php

namespace App\Http\Controllers\Api;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::select(['id', 'user_id', 'contview', 'title', 'discr'])-> orderBy('updated_at','DESC')->get();
        
        return view('index')->with([ 'articles' => $articles ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Article::class);
        
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Article::class);
                
        $this->validate($request, 
        [
            'title' => 'required|max:150',
            'text'  => 'required',
            'user_id' => 'required'
        ]);

        $articles = new Article;

        $discrible= $request->text;

        if (strlen($discrible)>437) $discrible = str_limit($discrible, 437); 

        $articles->title = $request->title;
        $articles->text = $request->text;
        $articles->discr = $discrible;
        $articles->user_id = $request->user_id;
        $articles->save();

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {    
        $article->contview = $article->contview+1;
        Article::where('id', $article->id)->update(['contview'=>$article->contview]); 
        
        return view('read')->with([ 'articles' => $article ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        
        return view('edit')->with([ 'articles' => $article ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);
        
        $this->validate($request, 
        [
            'title' => 'required|max:150',
            'text'  => 'required',
            'user_id' => 'required'
        ]);
        dump('iam here');
        $articles = Article::find($article->id);
        
        $discrible= $request->text;
        if (strlen($discrible)>437)  $discrible = str_limit($discrible, 437);
        
        $articles->title = $request->title;
        $articles->text = $request->text;
        $articles->discr = $discrible;
        $articles->save();
                
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        Article::where('id', $article->id)->delete();
        
        return redirect()->route('articles.index');
    }
}
