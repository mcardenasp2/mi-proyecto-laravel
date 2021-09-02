    @extends('dashboard.master')

@section('content')


<!-- {{var_dump($errors->any())}} -->



    @csrf
    <div class="form-group">
        <label for="title">Titulo</label>

        <input readonly class="form-control" type="text" value="{{$postComment->title}}">
        @error('title')
        <small class="text-danger">{{ $message}}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="url_clean">Usuario</label>

        <input readonly class="form-control" type="text"  value="{{$postComment->user->name}}">

    </div>

    <div class="form-group">
        <label for="url_clean">Aprovado</label>

        <input readonly class="form-control" type="text"  value="{{$postComment->approved}}">

    </div>

    <div class="form-group">
        <label for="content">Contenido</label>

        <textarea readonly class="form-control" type="text" rows="3" >{{$postComment->message}}</textarea>

    </div>

    <input type="submit" value="Enviar" class="btn btn-primary">

    
    
    



@endsection