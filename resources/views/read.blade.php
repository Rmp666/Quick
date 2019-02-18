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
            <div class="card-group">
                <span> Author = {{ $articles->user->name }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
