@extends ('layouts.app')

@section('content')
<script src="{{ asset('js/index.js') }}"></script>
<div class="container" >
    @foreach ($articles as $key => $article)
    <div class="card row pt-3 pb-3" >
        <div class = "col-md-12">
            <h2><a href="{{ route('articles.show', ['id'=>$article->id]) }}">{{ $article->title }}</a></h2>
        </div>
        <div class='col-md-12 text-justify pb-1'> 
            {{ $article->discr }}
        </div>
        <div class="col-md-12 ">
            <div class="row">
                <div class="col-md-3 mt-2">
                    @can('update', $article)
                    <a class="btn btn-light" href="{{ route('articles.edit', ['id'=>$article->id]) }}" class="mr-2">Edit</a>
                    @endcan
                    @can('delete', $article)
                    <button class="btn btn-light" type="button" data-action="modal-show" data-title="{{ $article->title }}"
                        data-route="{{ route('articles.destroy', ['id'=>$article->id]) }}">Delete</button>
                    @endcan
                </div>
                <div class="col-md-9 text-right"> <a>contview = {{ $article->contview }}</a></div>
            </div>
            @guest
            @else
            <div class="row mt-3">
                <div class="col-md-2">
                @foreach ($article->downloads as $download)
                    <a href="{{ route('load', $download) }}"> {{ $download->title }}</a>
                @endforeach
                </div>
            </div>
            @endguest 
        </div>
    </div>
    @endforeach
    

    
 

    <div id="modal" class="modal fade" data-dismiss="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Заголовок модального окна -->
                <div class="modal-header">
                    <h4 class="modal-title">Вы уверенны что хотите удалить данную статью?</h4>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body" id="titleMod"></div>
                <!-- Футер модального окна -->
                <div class="modal-footer">
                    <button type="button" id="cancel" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <form id="form-delete">
                        {{ method_field('DELETE') }}
                        @csrf
                        <button type="submit" class="btn btn-black">Удалить</button>
                    <form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
