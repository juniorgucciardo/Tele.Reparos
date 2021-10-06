
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
    .table{
        font-size: 0.86rem;
        table-layout: fixed;
 width:100%;
    }
    th{
        font-weight: 400;
    }
</style>

    <div class="card card-orange">
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
                        <div class="card-orange shadow card card-outline">
                            <div class="card-header d-flex justify-content-between items-center">
                                <i class="fas fa-user-circle"></i>
                                <span>Informações do usuário</span>
                            </div>
                            <div class="card-body">
                                <div class="row flex-column gap-3 justify-content-between">
                                    <img width="100px" height="100px" class="shadow border-md border-orange rounded-circle my-2 mx-auto" src="https://thispersondoesnotexist.com/image" alt="person">
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
                            <button class="btn bg-gradient-orange shadow" style="color: white">Ação</button>
                            <button class="btn bg-gradient-orange shadow" style="color: white">Ação</button>
                            <button class="btn bg-gradient-orange shadow" style="color: white">Ação</button>
                            </div>
                        </div>
                    </div>
        
                    <div class="">
                        <div class="card card-orange card-outline shadow">
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

                    <div class="card card-orange card-outline shadow">
                        <div class="card-header">
                            Alterar informações
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.update', $user->id) }}" method="POST">
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
                                    <div class="flex-column flex justify-center">
                                        <img width="120px" height="120px" class="border-md overlay border-orange rounded-circle my-2 mx-auto" src="https://thispersondoesnotexist.com/image" alt="person">
                                        <button class="btn-sm bg-gradient-orange shadow" style="color: white">Alterar</button>
                                    </div>
    
    
                                </div>
                            
                            
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn-sm bg-gradient-orange shadow" style="color: white">Salvar</button>
                            <button class="btn-sm bg-orange disabled  shadow" style="color: white">Cancelar</button>

                        </div>
                    </form>
                    </div>

                    <div class="card card-orange card-outline shadow">
                        <div class="card-header">
                            Observações
                        </div>
                        <div class="card-body">
                            <div class="post">
                                <div class="user-block">
                                    <img width="100px" height="100px" class="shadow border-md border-orange rounded-circle my-2 mx-auto" src="https://thispersondoesnotexist.com/image" alt="person">
                                  <span class="username">
                                    <a href="#">{{$user->name}}</a>
                                  </span>
                                  <span class="description">Shared publicly - 7:45 PM today</span>
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
                                    <th>Funcionário</th>
                                    <th>Status</th>
                                     @can('view_service_demands')
                                        <th> Funções </th>
                                    @endcan
                                </tr>
                            </thead>
                            @php
                           @endphp
                            <tbody>
                                @foreach ($user->attends as $attend)
                                <tr>
                                    <td>{{ $attend->id}}</td>
                                    <td>
                                        @php
                                            echo explode(' ', $attend->data_inicial)[0]
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                            echo explode(' ', $attend->data_inicial)[1]
                                        @endphp
                                    </td>
                                    <td>{{ $attend->orders->nome_cliente }}</td>
                                    <td>{{ $attend->orders->service->service_title }}</td>
                                    <td>{{$attend->orders->type->type_title}}</td>
                                    <td>
                                        @foreach ($attend->users as $user)
                                            @php
                                                $name = explode(' ', $user->name)[0];
                                            @endphp
                                        <span class="badge badge-primary">{{$name}}</span>
                                        @endforeach
                                    </td>
                                    <td>{{$attend->orders->status->status_title}}</td>
                                    @can('view_service_demands')
                                    <td>
                                        <div class="row d-flex nowrap">
                                            <a href="{{route('OS.contract', $attend->orders->id)}}">
                                                <button class="btn-sm btn-warning">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a>
                                                <a href="{{route('OS.edit', $attend->orders->id)}}">
                                                    <button class=" btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a>
                                                <form action="{{ route('OS.destroy', $attend->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn-sm btn-danger" type="submit">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                        </div>
                                        </td>
                                    @endcan
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
@stop