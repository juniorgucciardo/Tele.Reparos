
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h4>
    <i class="fas fa-file-contract mx-1"></i>
    Informações do {{$user->name}} 
  </h4>
@stop

@section('content')


<style>
    .prof_pic{
        height: 160px;
        width: 160px;
        object-fit: cover
    }

    input[type='file'] {
  display: none
}


</style>

    <div class="card card-navy">
        <div class="card-header">
            Informações
            @can('view_service_demands')
            <a href="{{ route('OS.export') }}"><button type="button" class="mx-1 btn-sm btn-outline-light"  ><i class="fas fa-info-circle mx-1"></i>Relatório geral</button></a>
            <a href="{{ route('OS.create') }}"><button type="button" class="mx-1 btn-sm btn-outline-light"  ><i class="fas fa-info-circle mx-1"></i>Novo registro</button></a>
            @endcan
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-3 col-12">
                    <div class="">
                        <div class="card-navy shadow card card-outline">
                            <div class="card-header d-flex justify-content-between items-center">
                                <i class="fas fa-user-circle"></i>
                                <span>Informações do usuário</span>
                            </div>
                            <div class="card-body">
                                <div class="row flex-column gap-3 justify-content-between">
                                    <img alt="80x80" class="prof_pic border-md border-navy rounded-circle my-2 mx-auto" src="/storage/usr_img/{{$user->user_img}}">
                                    <div class="">
                                        <strong>Nome:</strong><br>
                                        <span>{{$user->name}}</span>
                                    </div>
                                    <div class="my-2">
                                        <strong>Email:</strong><br>
                                        <span>{{$user->email}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-around">
                            <button class="btn bg-gradient-navy " style="color: white">Imprimir</button>
                            <button class="btn bg-gradient-navy " style="color: white">Histórico</button>
                            <button class="btn bg-gradient-navy " style="color: white">Ações</button>
                            </div>
                        </div>
                    </div>
        
                    <div class="">
                        <div class="card card-navy card-outline shadow">
                            <div class="card-header">
                                outras informações
                            </div>
                            <div class="card-body">
                                <div class="row my-1 d-flex justify-content-between">
                                    <div class="">
                                        <strong>cadastrado em:</strong><br>
                                        <span>{{$user->created_at}}</span>
                                    </div>
                                </div>
                                <div class="row my-1 d-flex justify-content-between">
                                    <div class="">
                                        <strong>atualizado em:</strong><br>
                                        <span>{{$user->updated_at}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-12">

                    <div class="card card-navy card-outline shadow">
                        <div class="card-header">
                            Alterar informações
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row d-flex justify-content-between items-center">
                                    <div class="col-8">
                                        <div class="">
                                            <label for="exampleInputEmail1">Nome:</label>
                                            <input type="text" name="name" class="form-control" id="exempleImputServiceTitle" value="{{$user->name}}">
                                        </div>
                                        <div class="my-2">
                                            <label for="exampleInputEmail1">Email:</label>
                                            <input type="text" name="email" class="form-control" id="exempleImputServiceTitle" value="{{$user->email}}">
                                        </div>
                                        
                                    </div>
                                    <div class="flex-column my-1 flex justify-center items-center mr-5 col-md-3 col-12">
                                        <img width="120px" height="120px" src="/storage/usr_img/{{$user->user_img}}" class="my-3 prof_pic border-md overlay border-navy rounded-circle mx-auto" onchange="loadFile(event)" id="output" alt="user_profile">
                                        <div class="custom-file text-center flex-column justify-content-center items-center">
                                            <label for="user_img" class="btn btn-sm btn-info">Selecione</label>
                                            <input type="file" name="user_img" id="user_img" accept="image/*" onchange="loadFile(event)">
                                        </div>
                                    </div>
                                </div>
                            
                            
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn-sm bg-gradient-navy " style="color: white">Salvar</button>
                            <button type="cancel" disabled data-target="{{route('user.view', $user->id)}}" class="btn-sm bg-navy disabled " style="color: white">Cancelar</button>

                        </div>
                    </form>
                    </div>
                    
                    {{-- POSTS, AVALIAÇÕES --}}
                    @php
                        $u = $user;
                    @endphp
                    @can('view_service_demands')
                    <div class="card card-navy card-outline shadow">
                        <div class="card-header">
                            Avaliações
                        </div>
                        <div class="card-body">
                            @foreach ($user->reviewsAboutMe as $review)
                            <div class="post">
                                <div class="user-block">
                                    <img width="100px" height="100px" class="prof_pic border-md border-navy rounded-circle my-2 mx-auto" src="/storage/usr_img/{{$review->ownerReview->user_img}}" alt="person">
                                  <span class="username">
                                    <a href="#">{{$review->ownerReview->name}}</a>
                                  </span>
                                  <span class="description">Publicado às - {{ date('H:i A', strtotime(explode(' ', $review->created_at)[1])) }} dia {{ date('d/m', strtotime(explode(' ', $review->created_at)[0])) }}</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                  {{$review->content}}
                                </p>
          
                                <p>
                                  <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Ver anexos</a>
                                  <form action="{{ route('reviews.destroy', $review->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm ml-auto"><i class="fas fa-trash"> Excluir</i></button>
                                </form>
                                </p>
                              </div>
                            @endforeach                              
                            
                                <button type="button" class="btn btn-outline-info rounded" data-toggle="modal" data-target="#addModal" data-whatever="@getbootstrap">Adicionar avaliação</button>
                                 @include('admin.pages.modal.include_review')
                                
                            </div>
                            @endcan
                        
                    </div>

                    


                </div>


            </div>




            <div class="card">
                <div class="card-header">
                    Atendimentos deste usuário
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @include('admin.pages.tables.table-user', $attends)
                    </div>
                </div>
            </div>


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