@extends('dashboard.master')

@section('content')


<div class="form-group">
    <label for="name">Nombre</label>
    <input readonly class="form-control" type="text" id="name" name="name" value="{{old('name',$user->name)}}" >

</div>

<div class="form-group">
    <label for="surname">Apellido</label>
    <input readonly class="form-control" type="text" id="surname" name="surname" value="{{old('surname',$user->surname)}}" >

</div>

<!-- <input type="submit" value="Enviar" class="btn btn-primary"> -->

@endsection