
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h4>
    <i class="fas fa-truck-moving mx-1"></i>
    Atendimentos
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
            <a href="{{ route('OS.export') }}"><button type="button" class="mx-1 btn-sm btn-light"  ><i class="fas fa-info-circle mx-1"></i>Relatório geral</button></a>
            <a href="{{ route('OS.create') }}"><button type="button" class="mx-1 btn-sm btn-light"  ><i class="fas fa-info-circle mx-1"></i>Novo registro</button></a>
            @endcan
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
                                    <td>{{$attend->status->status_title}}</td>
                                    @can('view_service_demands')
                                    <td>
                                        <div class="row d-flex nowrap">
                                            <a href="{{url("admin/OS/editar/$attend->id")}}">
                                                <button class="btn-sm btn-warning">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a>
                                                <a href="{{url("admin/atendimentos/editar/$attend->id")}}">
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