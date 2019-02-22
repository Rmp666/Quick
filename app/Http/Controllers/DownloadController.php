<?php

namespace App\Http\Controllers;

use App\Download;
use App\Article;
use Illuminate\Http\Request;

class DownloadController  extends Controller 
{
    public function store(Request $request)
    {
        $data = $request->all();
        $idFiles =[];
        
        foreach ($data['upload'] as $keys => $values)
        {
            $file = $values['file'];
            
            // Сохранение файла на локальном диске public
            $path = $file->store('uploads', 'public');
            
            // Сохранение файла в БД
            $download = Download::create(
            [
                'title' => $values['fileName'],
                'path' => $path,
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ]);
            
            array_push($idFiles, $download->id);
        }
        
        // Массив с id для привязки к статье
        return $idFiles;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Download $download)
    {
        // Удаляем связи с файлом для статьи, id которой передали в Request
        $article = Article::where('id', $request->id)->first();
        $article->downloads()->detach($download->id);
        
        // Количество файлов привязанное к статье после удаления
        $count = $article->downloads()->count();
                
        //Удаляем файл из папки Storage
        if(!\Storage::disk('public')->delete($download->path))
        {
            return ['result' => 'Dont remove this file'];
        }
        // Удаляем файл из бд
        
        if ($download->delete())
        {
            return ['result' => 'Delete success', 'countFiles' =>$count];
        }
    }   
    
    // Формирование ссылок и заголовков для загрузки файла с сервера
    public function load(Download $download)
    {
        return response()->download(storage_path('app/public/'. $download->path));
    }
}
