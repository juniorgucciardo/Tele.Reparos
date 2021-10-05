
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h4>
    <i class="fas fa-file-contract mx-1"></i>
    Informações do contrato nº {{$contract->id}} 
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

    <div class="card card-info">
        <div class="card-header">
            Informações
            @can('view_service_demands')
            <a href="{{ route('OS.export') }}"><button type="button" class="mx-1 btn btn-outline-light"  ><i class="fas fa-info-circle mx-1"></i>Relatório geral</button></a>
            <a href="{{ route('OS.create') }}"><button type="button" class="mx-1 btn btn-outline-dark"  ><i class="fas fa-info-circle mx-1"></i>Novo registro</button></a>
            @endcan
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="">
                        <div class="card">
                            <div class="card-header">
                                Informações do cliente
                            </div>
                            <div class="card-body">
                                <div class="row d-flex justify-content-between">
                                    <div class="">
                                        <strong>Nome:</strong><br>
                                        <span>{{$contract->nome_cliente}}</span>
                                    </div>
                                    <div class="">
                                        <strong>Contato:</strong><br>
                                        <span>{{$contract->contato_cliente}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="">
                        <div class="card">
                            <div class="card-header">
                                Endereço
                            </div>
                            <div class="card-body">
                                <div class="row my-1 d-flex justify-content-between">
                                    <div class="">
                                        <strong>Rua:</strong><br>
                                        <span>{{$contract->rua_cliente}}, {{$contract->numero_cliente}}</span>
                                    </div>
                                </div>
                                <div class="row my-1 d-flex justify-content-between">
                                    <div class="">
                                        <strong>Bairro:</strong><br>
                                        <span>{{$contract->bairro_cliente}}</span>
                                    </div>
                                    <div class="">
                                        <strong>Cidade :</strong><br>
                                        <span>{{$contract->cidade_cliente}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-12">

                    <div class="card">
                        <div class="card-header">
                            Informações sobre o serviço
                        </div>
                        <div class="card-body">
                            <div class="row d-flex justify-content-between">
                                <div class="col-6">
                                    <div class="">
                                        <strong>Serviço:</strong><br>
                                        <span>{{$contract->service->service_title}}</span>
                                    </div>
                                    <div class="my-2">
                                        <strong>Descrição do serviço:</strong><br>
                                        <span>{{$contract->descricao_servico}}</span>
                                    </div>
                                    <div class="">
                                        <strong>Serviço:</strong><br>
                                        <span>{{$contract->service->service_title}}</span>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <div class="my-2">
                                        <strong>Tipo de serviço:</strong><br>
                                        <span>{{$contract->type->type_title}}</span>
                                    </div>
                                    <div class="">
                                        <strong>Recorrência:</strong><br>
                                        <span>{{$contract->recurrence}}</span>
                                    </div>
                                    <div class="my-2">
                                        <strong>Quantidade de atendimentos:</strong><br>
                                        <span>{{$contract->amount}}</span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Outras informações
                        </div>
                        <div class="card-body">
                            <strong>Cadastrado em:</strong><br>
                            <span>{{$contract->created_at}}</span>
                        </div>
                    </div>

                    


                </div>


            </div>




            <div class="card">
                <div class="card-header">
                    Atendimentos deste contrato
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
                               @foreach ($attends as $attend)
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
                                            <a href="{{url("admin/OS/editar/$attend->id")}}">
                                                <button class="btn-sm btn-warning">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a>
                                                <a href="{{url("admin/OS/editar/$attend->id")}}">
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