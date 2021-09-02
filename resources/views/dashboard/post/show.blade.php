@extends('dashboard.master')

@section('content')


<!-- {{var_dump($errors->any())}} -->



    @csrf
    <div class="form-group">
        <label for="title">Titulo</label>

        <input readonly class="form-control" type="text" name="title" id="title" value="{{$post->title}}">
        @error('title')
        <small class="text-danger">{{ $message}}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="url_clean">Url Limpio</label>

        <input readonly class="form-control" type="text" name="url_clean" id="url_clean" value="{{$post->url_clean}}">

    </div>

    <div class="form-group">
        <label for="content">Contenido</label>

        <textarea readonly class="form-control" type="text" rows="3" name="content" id="content">{{$post->content}}</textarea>

    </div>

    <input type="submit" value="Enviar" class="btn btn-primary">

    
    
    



@endsection