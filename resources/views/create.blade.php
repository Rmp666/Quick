@extends ('layouts.app')

@section('content')
<div class="container">
    @include('errors.request_errors')
    <form method="POST" action="{{ route('articles.store') }}" id="createEditForm">
        @csrf
        <div class="card">
            
            <div class="card-header">
                <input class="full" type="text" class="card-control" placeholder="Enter the title of your article" name="title" data-validate="true" required>
            </div>
            
            <div class="card-body cardtext">
                <textarea class="full" rows="15" placeholder="Enter the text of your article" name="text" data-validate="true" required></textarea>
            </div>
            
            <div class="card-footer">
                <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group" role="group" aria-label="First group">
                        <button class="btn btn-light" type="submit" id="publish">Publish</button>
                    </div>
                    <div class="input-group">
                        <button class="btn btn-light pull-right" id="addFile" type="button" aria-label="Input group example" aria-describedby="btnGroupAddon2">
                            Add files to your article
                        </button>
                    </div>
                </div>
            </div>
            
            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id"></input>
            <input type="hidden"  name="download_id"></input>
        </div>    
    </form>
    @include('downloads.upload')
</div>

@endsection
