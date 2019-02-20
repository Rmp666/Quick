@if (count($errors)>0) 
<div class="text-danger">
    @foreach ($errors->all() as $error)
        <span>{{$error}}</span><br/>
    @endforeach
</div>
@endif

