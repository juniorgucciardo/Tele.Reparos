
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h4>
    <i class="fas fa-file-contract mx-1"></i>
    Contratos e serviços
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
            Ordens de Serviço
            @can('view_service_demands')
            <a href="{{ route('OS.export') }}"><button type="button" class="mx-1 btn btn-info btn-outline"  ><i class="fas fa-info-circle mx-1"></i>Relatório geral</button></a>
            <a href="{{ route('OS.create') }}"><button type="button" class="mx-1 btn btn-info btn-outline"  ><i class="fas fa-info-circle mx-1"></i>Novo registro</button></a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Atividade</th>
                            <th>Tipo</th>
                            <th>Cidade</th>
                            <th>Recorrencia</th>
                            <th>Duração do contrato</th>
                             @can('view_service_demands')
                                <th> Funções </th>
                            @endcan
                        </tr>
                    </thead>
                    @php
                   @endphp
                    <tbody>
                       @foreach ($service_orders as $order)
                        <tr>
                            <td>{{ $order->nome_cliente }}</td>
                            <td>{{ $order->service->service_title}}</td>
                            <td>{{$order->type->type_title}}</td>                           
                            <td>{{ $order->cidade_cliente }}</td>
                            <td>{{ $order->recurrence}}</td>
                            <td>{{$order->attends_count}}</td>
                            @can('view_service_demands')
                            <td>
                                <div class="row d-flex nowrap">
                                    <a href="{{url("admin/detalhes-contrato/$order->id")}}">
                                        <button class="btn-sm btn-warning">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                        <a href="{{url("admin/OS/editar/$order->id")}}">
                                            <button class="mx-1 btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('OS.destroy', $order->id)}}" method="post">
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
@stop