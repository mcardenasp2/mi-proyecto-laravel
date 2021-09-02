@extends('dashboard.master')

@section('content')


<!-- {{var_dump($errors->any())}} -->

<!-- @include('dashboard.partials.validation-error') -->

<div class="col-6 mb-3">
  <form action="{{route('post-comment.post', 1)}}" id="filterForm">

    <div class="form-row">
      <div class="col-10">
        <select name="" id="filterPost" class="form-control">
          @foreach ($posts as $p)
          <option value="{{$p->id}}"
            {{$post->id==$p->id ? 'selected':''}}
            
            >{{ Str::limit($p->title,80) }}</option>
        
          @endforeach
        </select>
      </div>
      <div class="col-2">
        <button class="btn btn-success" type="submit">Enviar</button>

      </div>
    </div>

 

  </form>
  
  

</div>

@if (count($postComments)>0)
    


<table class="table">
    <thead>
        <tr>
            <td>Id</td>
            <td>Titulo</td>
            <td>Aprovado</td>
            <td>Usuario</td>
            <td>Creacion</td>
            <td>Actualizacion</td>
            <td>Acciones</td>
        </tr>
    </thead>

    <tbody>
        @foreach($postComments as $postComment)
            <tr>
                <td>{{$postComment->id}}</td>
                <td>{{$postComment->title}}</td>
                <td>{{$postComment->approved}}</td>
                {{-- <td>{{$postComment->user->name}}</td> --}}
                <td>{{$postComment->user->name}}</td>
                <td>{{$postComment->created_at->format('d-m-Y')}}</td>
                <td>{{$postComment->updated_at->format('d-m-Y')}}</td>
                <td>
                    <a href="{{route('post-comment.show', $postComment->id)}}" class="btn btn-primary">Ver</a>
                    
                    <!-- <form method="POST" action="{{route('post-comment.destroy', $postComment->id)}}">
                        @method('DELETE')
                        @csrf -->

                        <button class="btn btn-success" data-toggle="modal" data-target="#showModal" data-id="{{$postComment->id}}">Ver</button>

                        <button class="aproved btn btn-{{$postComment->approved==1?"success":"danger"}}"  data-id="{{$postComment->id}}">{{$postComment->approved==1?"Aprobado":"Rechazado"}}</button>
                        
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$postComment->id}}">Eliminar</button>

                    <!-- </form> -->
                    
                    <!-- <a href="{{route('post-comment.destroy', $postComment->id)}}" class="btn btn-danger">Eliminar</a> -->

                </td>
            
            </tr>

        @endforeach    
    </tbody>
</table>
{{$postComments->links()}}



{{-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Seguro que desea borrar el registro seleccionado</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
       

        <form id="formDelete" method="POST" action="{{route('post.destroy', 0)}}" data-action="{{route('post.destroy', 0)}}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Borrar</button>

        </form>       
      </div>
    </div>
  </div>
</div> --}}


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Seguro que desea borrar el registro seleccionado</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
       

        <form id="formDelete" method="POST" action="{{route('post-comment.destroy', 0)}}" data-action="{{route('post-comment.destroy', 0)}}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Borrar</button>

        </form>       
      </div>
    </div>
  </div>
</div>







<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="message"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
       

           
      </div>
    </div>
  </div>
</div>


<script>
  document.querySelectorAll(".aproved").forEach(button => button.addEventListener("click", function(){
      console.log("Hola Mundo "+button.getAttribute("data-id"));
      var id=button.getAttribute("data-id");
      console.log(id);

      var formData= new FormData();
      formData.append("_token",'{{csrf_token()}}');

      fetch("{{URL::to("/")}}/dashboard/post-comment/proccess/"+id,{
        method:'POST',
        body:formData
      })
                .then(response=>response.json())
                .then(approved=>{
                  if(approved==1){
                    button.classList.remove('btn-danger');
                    button.classList.add('btn-success');
                    button.innerHTML="Aprobado";
                    // $(button).removeClass('btn-danger');
                    // $(button).addClass('btn-success');
                    // $(button).text("Aprobado")

                  }else{
                    button.classList.remove('btn-success');
                    button.classList.add('btn-danger');
                    button.innerHTML="Rechazado";
                    // $(button).removeClass('btn-success');
                    // $(button).addClass('btn-danger');
                    // $(button).text("Rechazado")
                  }
                });


      // $.ajax({
      //     method:"POST",
      //     url:"{{URL::to("/")}}/dashboard/post-comment/proccess/"+id,
      //     data:{'_token':'{{csrf_token()}}'}
          
      //   }).done(function(approved){
      //     console.log(approved)
      //       if(approved==1){
      //         $(button).removeClass('btn-danger');
      //         $(button).addClass('btn-success');
      //         $(button).text("Aprobado")

      //       }else{
      //         $(button).removeClass('btn-success');
      //         $(button).addClass('btn-danger');
      //         $(button).text("Rechazado")
      //       }
      //   }).fail(function(e) {
      //     alert( "error" +e);
      //   });
      
  }))
  




window.onload= function(){

  $('#deleteModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  // console.log('ssss')
  action =$('#formDelete').attr('data-action').slice(0,-1);
  action+=id;

  $('#formDelete').attr('action', action);

  
  var modal = $(this)
  modal.find('.modal-title').text('Vas a borrar el POST: ' + id)
//   modal.find('.modal-body input').val(id)
});

  $('#showModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  // console.log('jejedd')
  var modal = $(this)
  
  /*$.ajax({
    method:"GET",
    url:"{{URL::to("/")}}/dashboard/post-comment/j-show/"+id
    
  }).done(function(comment){
    // console.log('bueno')
    modal.find('.modal-title').text(comment.title)
    modal.find('.message').text(comment.message)
  }).fail(function() {
    alert( "error" );
  });
*/

fetch("{{URL::to("/")}}/dashboard/post-comment/j-show/"+id)
                .then(response=>response.json())
                .then(comment=>{
                  modal.find('.modal-title').text(comment.title)
                  modal.find('.message').text(comment.message)
                });
  
 
  modal.find('.modal-body input').val(id)
});


        $('#filterForm').submit(function(){
          // e.preventDefault();
          
          // console.log('jdjdj')
            console.log($(this).val())
            var action =$('#filterForm').attr('action');
            action=action.replace(/[0-9]/g,$('#filterPost').val());
            // action=action.replace(/[0-9]/,$(this).val());
            // action=action.replace(/[3,4,5,6,9]/,$(this).val());
            // console.log(action)
            $(this).attr('action','http://localhost:8000/dashboard/post-comment/'+$('#filterPost').val()+'/post')
        });
    


  
};




</script>

@else
<h1>No hay comentarios para el post Seleccioando</h1>

@endif

<script>

    // window.onload= function(){
    //     $('#filterForm').submit(function(){
    //       // e.preventDefault();
          
    //       // console.log('jdjdj')
    //         console.log($(this).val())
    //         var action =$('#filterForm').attr('action');
    //         action=action.replace(/[0-9]/g,$('#filterPost').val());
    //         // action=action.replace(/[0-9]/,$(this).val());
    //         // action=action.replace(/[3,4,5,6,9]/,$(this).val());
    //         // console.log(action)
    //         $(this).attr('action','http://localhost:8000/dashboard/post-comment/'+$('#filterPost').val()+'/post')
    //     });
    // }
</script>


@endsection