<?php

namespace App\Http\Controllers;

use App\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DownloadController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $idFiles =[];
        
        foreach ($data['upload'] as $keys => $values)
        {
            $file = $values['file'];
            $path = $file->store('uploads', 'public');
            
            $download = Download::create(
            [
                'title' => $values['fileName'],
                'path' => $path,
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ]);
            
            array_push($idFiles, $download->id);
        }
        
        return $idFiles;
        // dump( $boo=Arr::dot($request->file('upload')) );
        //$request->all();
    }

    public function update(Request $request, Download $download)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function destroy(Download $download)
    {
        //
    }
    
    public function load(Download $download)
    {
        return response()->download(storage_path('app/public/'. $download->path));
    }
}
