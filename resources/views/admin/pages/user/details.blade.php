
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


    .table{
        font-size: 0.86rem;
        table-layout: fixed;
        width:100%;
    }
    th{
        font-weight: 400;
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
                            <button class="btn-sm bg-navy disabled " style="color: white">Cancelar</button>

                        </div>
                    </form>
                    </div>

                    <div class="card card-navy card-outline shadow">
                        <div class="card-header">
                            Avaliações
                        </div>
                        <div class="card-body">
                            <div class="post">
                                <div class="user-block">
                                    <img width="100px" height="100px" class=" border-md border-navy rounded-circle my-2 mx-auto" src="https://thispersondoesnotexist.com/image" alt="person">
                                  <span class="username">
                                    <a href="#">{{$user->name}}</a>
                                  </span>
                                  <span class="description">Publicado às - {{explode(' ', $user->attends[0]->data_inicial)[1]}} PM | dia {{explode(' ', $user->attends[0]->data_inicial)[0]}}</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                  Lorem ipsum represents a long-held tradition for designers,
                                  typographers and the like. Some people hate it and argue for
                                  its demise, but others ignore.
                                </p>
          
                                <p>
                                  <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Ver anexos</a>
                                </p>
                              </div>
                              <div class="post">
                                <div class="user-block">
                                    <img width="100px" height="100px" class=" border-md border-navy rounded-circle my-2 mx-auto" src="https://thispersondoesnotexist.com/image" alt="person">
                                  <span class="username">
                                    <a href="#">{{$user->name}}</a>
                                  </span>
                                  <span class="description">Publicado às - {{explode(' ', $user->attends[2]->data_inicial)[1]}} PM | dia {{explode(' ', $user->attends[2]->data_inicial)[0]}}</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                  Lorem ipsum represents a long-held tradition for designers,
                                  typographers and the like. Some people hate it and argue for
                                  its demise, but others ignore.
                                </p>
          
                                <p>
                                  <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                                </p>
                              </div>
                              
                        </div>
                    </div>

                    


                </div>


            </div>




            <div class="card">
                <div class="card-header">
                    Atendimentos deste usuário
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>cliente</th>
                                    <th>Atividade</th>
                                    <th>Tipo</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            @php
                           @endphp
                            <tbody>
                                @foreach ($attends as $attend)
                                <tr>
                                    <td>{{ $attend->id}}</td>
                                    <td>
                                        @php
                                            $data = explode(' ', $attend->data_inicial)[0];
                                            $data = date('d/m', strtotime($data));
                                        @endphp
                                        {{$data}}
                                    </td>
                                    <td>
                                        @php
                                            $hora = explode(' ', $attend->data_inicial)[1];
                                            $hora = date('H:i', strtotime($hora));
                                        @endphp
                                        {{$hora}}
                                    </td>
                                    <td>{{ $attend->orders->nome_cliente }}</td>
                                    <td>{{ $attend->orders->service->service_title }}</td>
                                    <td>{{$attend->orders->type->type_title}}</td>
                                    
                                    <td>{{$attend->status->status_title}}</td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
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