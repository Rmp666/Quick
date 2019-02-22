@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class=" card-group">
                <div class= "text-center">{{ $articles->title }}</div>
            </div>
        </div>
        <div class="card-body">
            <div class=" card-group">
                <div class= "text-center text-justify">{{$articles->text}}</div>
            </div>
        </div>
        <div class="card-footer">
            <div class="card-group">
                <span> Contview = {{ $articles->contview }}</span>
            </div>
            <div class="card-group mt-3">
                <span> Author: {{ $articles->user->name }}</span>
            </div>
        </div>
    </div>
    
    @isset($articles->downloads['0'])
    <div class="text-center">Download files</div>
        <div class="card-footer">
            <div class="row">
            @foreach ($articles->downloads as $download)
                <div class="col-md-2">
                    <a class="btn btn-light" href="{{ route('load', $download) }}">{{ $download->title }}</a>
                </div>
            @endforeach
            </div>
        </div>
    @endisset 
</div>
@endsection
