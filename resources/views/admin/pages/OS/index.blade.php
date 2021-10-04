
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
                            <th>Atividade</th>
                            <th>Cliente</th>
                            <th>Data</th>
                            <th>Cliente</th>
                            <th>Endereço</th>
                            <th>Cidade</th>
                            <th>Atend...</th>
                            <th>Tipo</th>
                            <th>Func...</th>
                            <th>Status</th>
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
                            <td>{{ $order->service->service_title}}</td>
                            <td>{{ $order->nome_cliente }}</td>
                            <td>{{ $order->data_ordem }}</td>
                            <td>{{ $order->nome_cliente }}</td>
                            <td>{{ $order->rua_cliente }}, {{ $order->numero_cliente }}</td>
                            <td>{{ $order->cidade_cliente }}</td>
                            <td>{{$order->attends_count}}</td>
                            <td>{{$order->type->type_title}}</td>
                            <td>
                                @foreach ($order->user as $user)
                                    @php
                                        $name = explode(' ', $user->name)[0];
                                    @endphp
                                <span class="badge badge-primary">{{$name}}</span>
                                @endforeach
                            </td>
                            <td>{{$order->status->status_title}}</td>
                            @can('view_service_demands')
                            <td>
                                <div class="row d-flex nowrap">
                                    <a href="{{url("admin/OS/editar/$order->id")}}">
                                        <button class="btn-sm btn-warning">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                        <a href="{{url("admin/OS/editar/$order->id")}}">
                                            <button class=" btn-sm btn-primary">
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