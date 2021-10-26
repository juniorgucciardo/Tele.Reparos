
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h4>
    <i class="fas fa-rss-square"></i>
    Blog
  </h4>
@stop

@section('content')
  <div class="card">
      <div class="card-header">
        <h5>Todas as postagens</h5>
      </div>
      <div class="card-body">
          <a class="btn btn-primary" href="{{route('blog.create')}}">Criar nova postagem</a>
        <table class="table table-bordered">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Titulo</th>
                <th scope="col">Url</th>
                <th scope="col">Imagem</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->title}}</td>
                    <td>{{!! $post->content !!}}</td>
                    <td>
                        <div class="flex-column">
                            <img width="100px" height="100px" style="object-fit: cover;" src="/storage/blog/{{$post->img_post}}" alt="">
                            {{$post->img_post}}
                        </div>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">visualizar</button>
                            <button type="button" class="btn btn-warning">editar</button>
                            <button type="button" class="btn btn-danger">deletar</button>
                        </div>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
      <div class="card-footer">
          footer
      </div>
  </div>
@stop