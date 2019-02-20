@extends ('layouts.app')

@section('content')
<div class="container">
    @include('errors.request_errors')
    <form method="POST" action="{{ route('articles.update',  ['id'=>$articles->id]) }}">
        {{ method_field('PUT') }}
        @csrf
        <div class="card row">
            <div class="card-header">
                <input class="full" type="text" class="card-control" name="title" value="{{ $articles->title }}">
            </div>
            <div class="card-body cardtext">
                <textarea class="full" name="text">{{ $articles->text }}</textarea>
            </div>
            <div class="card-footer">
                
               <button class="btn btn-black" type="submit">Update</button>
            </div>
            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
        </div>    
    </form>
    @include('downloads.upload')
</div>
@endsection
