


    @csrf
    <div class="form-group">
        <label for="title">Titulo</label>

        <input class="form-control" type="text" name="title" id="title" value="{{old('title',$post->title)}}">
        @error('title')
        <small class="text-danger">{{ $message}}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="url_clean">Url Limpio</label>

        <input class="form-control" type="text" name="url_clean" id="url_clean" value="{{old('url_clean',$post->url_clean)}}">

    </div>

    <div class="form-group">
        <label for="category_id">Categorias</label>

        <select class="form-control" name="category_id" id="category_id">
            @foreach($categories as $title=>$id)
                <option {{$post->category_id==$id?'selected="selected"':''}} value="{{$id}}"> {{ $title}}</option>

            @endforeach

        </select>
    </div>

    <div class="form-group">
        <label for="posted">Posted</label>

        <select class="form-control" name="posted" id="posted">
            @include('dashboard.partials.option-yes-not',['val'=>$post->posted])

        </select>
    </div>


    <div class="form-group">
        <label for="category_id">Tags</label>

        <select multiple class="form-control" name="tags_id[]" id="tags_id">
            @foreach($tags as $title=>$id)
                <option {{in_array($id,old('tags_id')?:$post->tags->pluck("id")->toArray())?"selected":""}} value="{{$id}}"> {{ $title}}</option>

            @endforeach

        </select>
    </div>



    <div class="form-group">
        <label for="content">Contenido</label>

        <textarea class="form-control" type="text" rows="3" name="content" id="content">{{old('content',$post->content)}}</textarea>

    </div>

    <input type="hidden" id="token" value="{{csrf_token()}}">
    <input type="submit" value="Enviar" class="btn btn-primary">

    


