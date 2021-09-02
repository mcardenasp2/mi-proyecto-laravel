@csrf 

<div class="form-group">
    <label for="title">Titulo</label>
    <input class="form-control" type="text" id="title" name="title" value="{{old('title',$categories->title)}}" >

</div>

<div class="form-group">
    <label for="url_clean">Url Limpio</label>
    <input class="form-control" type="text" id="url_clean" name="url_clean" value="{{old('url_clean',$categories->url_clean)}}">

</div>

<input type="submit" value="Enviar" class="btn btn-primary">