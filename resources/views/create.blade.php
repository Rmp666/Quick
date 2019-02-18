@extends ('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('articles.store') }}">
        @csrf
        <div class="card row">
            <div class="card-header">
                <input class="full" type="text" class="card-control" placeholder="Enter the title of your article" name="title">
            </div>
            <div class="card-body cardtext">
                <textarea class="full" rows="20" placeholder="Enter the text of your article" name="text"></textarea>
            </div>
            <div class="card-footer">
               <button class="btn btn-black" type="submit">Create</button>
            </div>
            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id"></input>
        </div>    
    </form>
</div>
@endsection
