<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Download;
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
        $articles = Article::with('downloads')->paginate(4);
        return view('index')->with([ 'articles' => $articles]);
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

        $request->validate(
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
        
        // Создаем новые связи с файлами в downloadable
        if ($request->download_id !== null)
        {
            $downloads = explode(',', $request['download_id']);
            
            foreach ($downloads as $id)
            {
                $articles->downloads()->attach($id);
            }
        }
        
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
        
        return view('read')->with([ 'articles' => $article::with('downloads')->where('id', $article->id)->first() ]);
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
       
        return view('edit')->with([ 'articles' => $article::with('downloads')->findOrFail($article->id)]);
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

        $articles = Article::find($article->id);
        
        $discrible= $request->text;
        if (strlen($discrible)>437)  $discrible = str_limit($discrible, 437);
        
        $articles->title = $request->title;
        $articles->text = $request->text;
        $articles->discr = $discrible;
        $articles->save();
        
        if ($request->download_id !== null)
        {
            // Создаем новые связи с файлами в downloadable
            $downloads = explode(',', $request['download_id']);
            
            foreach ($downloads as $id)
            {
                $articles->downloads()->attach($id);
            }
        }
                
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
        // Удаляем файлы связанные с данной статьей из БД и из storage
        $articleWithFile = $article::with('downloads')->where('id', $article->id)->first();
        
        foreach ($articleWithFile->relationsToArray() as $values)
        {
            foreach ($values as $name => $value)
            {
                Download::where('id', $value['id'])->delete();
                \Storage::disk('public')->delete($value['path']);
            }
        }
       
        // Удаляем все связи с таблицей downloadable
        $article->downloads()->detach();
        // Удаляем статью из бд
        $article->delete();
      
        return redirect()->route('articles.index');
    }
}
