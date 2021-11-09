
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h4>
    <i class="fas fa-rss-square"></i>
    Blog
</h4>
  
@stop

@section('content')
<style>
      input[type='file'] {
  display: none
}
</style>
<div class="card card-info">
  <div class="card-header">
    Adicione uma nova postagem
  </div>
  <div class="card-body">
    <form action="{{route('blog.create')}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('POST')
    <div class="form-group">
      <div class="card card-outline card-info shadow">
        <div class="card-header">
          <i class="fas fa-user-friends mx-1"></i>
          Informações sobre o post
        </div>
        <div class="card-body">
            <div class="col-md-6 col-12">
              <label for="exampleInputEmail1">Título</label>
              <input required type="text" name="title" class="form-control" id="exempleImputServiceTitle" placeholder="Nome do cliente">
            </div>
            <div class="col-md-8 col-12 my-2">
              <label for="exampleFormControlTextarea1">Conteúdo</label>
              <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="flex-column my-1 col-md-3 col-12">
              <img width="200px" height="200px" src="https://www.madeireiraestrela.com.br/images/joomlart/demo/default.jpg" class="my-3 border-md overlay" onchange="loadFile(event)" id="output" alt="user_profile">
              <div class="custom-file">
                  <label for="blog-img" class="btn btn-sm btn-info">Selecione</label>
                  <input type="file" name="blog-img" id="blog-img" accept="image/*" onchange="loadFile(event)">
              </div>
          </div>
          <div class="col-md-4 col-12">
            <label for="exampleInputEmail1">Categoria</label>
            <input required type="text" name="category" class="form-control" id="exempleImputServiceTitle" placeholder="categoria">
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-info">cadastrar post</button>
    </div>
    </form>
  </div>
</div>

<script>
  var loadFile = function(event) {
  var output = document.getElementById('output');
  output.src = URL.createObjectURL(event.target.files[0]);
  output.onload = function() {
    URL.revokeObjectURL(output.src) // free memory
  }
};

</script>


@stop