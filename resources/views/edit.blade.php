@extends ('layouts.app')

@section('content')
<div class="container">
<script src="{{ asset('js/edit_view.js') }}"></script>
@include('errors.request_errors')
  
    <form method="POST" action="{{ route('articles.update',  ['id'=>$articles->id]) }}" id="createEditForm">
        {{ method_field('PUT') }}
        @csrf
        <div class="card">
            <div class="card-header">
                <input class="full" type="text" class="card-control" name="title" value="{{ $articles->title }}" data-validate="true" required >
            </div>
            <div class="card-body cardtext">
                <textarea class="full" rows="12" data-validate="true" name="text" required>{{ $articles->text }}</textarea>
            </div>
            <div class="card-footer">
                <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group" role="group" aria-label="First group">
                        <button class="btn btn-light" type="submit" id="publish">Publish</button>
                    </div>
                    <div class="input-group">
                        <button class="btn btn-light" id="addFile" type="button" aria-label="Input group example" aria-describedby="btnGroupAddon2">
                            Add more files
                        </button>
                    </div>
                </div>
            </div>
            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
            <input type="hidden"  name="download_id"></input>
        </div>    
    </form>
    <!-- Окно для скачивания и удаления файла -->
    @isset($articles->downloads['0'])
    <div class="card mt-2 file-foot">
        <div class="card-footer">
            @foreach ($articles->downloads as $download)
            <div class="btn-toolbar justify-content-between" id="{{ $download->id }}" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group" role="group" aria-label="First group">
                    <a class="btn btn-light" href="{{ route('load', $download) }}">Download {{ $download->title }}</a>
                </div>
                <div class="input-group">
                    <button class="btn btn-light pull-right" type="button" data-article ="{{ $articles->id }}" id="showModal" data-download="{{ $download }}" aria-label="Input group example" aria-describedby="btnGroupAddon2">
                        Delete
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endisset 
    <!-- Модальное окно для удаления файла через axios -->
    <div id="modal" class="modal fade" data-dismiss="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Заголовок модального окна -->
                <div class="modal-header">
                    <h4 class="modal-title">Are you sure you want to delete this file?</h4>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body" id="titleMod"></div>
                <!-- Футер модального окна -->
                <div class="modal-footer">
                    <button type="button" id="cancel" class="btn btn-light" data-dismiss="modal">Отмена</button>
                    <button type="button d-none" class="btn btn-light" id="deleteFile">Удалить</button>
                </div>
            </div>
        </div>
    </div>
    
@include('downloads.upload')
</div>
@endsection
