
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nossos serviços - TeleREPAROS</h1>
@stop

@section('content')

    <div class="card card-info">
        <div class="card-header">
            Ordens de Serviço
            @can('view_service_demands')
            <a href="{{ route('OS.export') }}"><button type="button" class="mx-1 btn btn-primary"  ><i class="fas fa-info-circle"></i>Relatório Geral</button></a>
            <a href="{{ route('OS.export') }}"><button type="button" class="mx-1 btn btn-primary"  ><i class="fas fa-info-circle"></i>Relatório Geral</button></a>
            @endcan
        </div>
        <div class="card-body">
            <table id="table" class="table table-condensed">
                <thead>
                    <tr>
                        <th>Atividade</th>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Funcionario</th>
                        @can('view_service_demands')
                            <th>Status</th>
                            <th>Visualizar</th>
                            <th>Alterar</th>
                            <th>Excluir</th>
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
                            <a href="{{url("admin/OS/editar/$order->id")}}">
                                <button class="btn btn-warning">Visualizar</button>
                            </a>
                        </td>
                        
                            <td>
                                <a href="{{url("admin/OS/editar/$order->id")}}">
                                    <button class="btn btn-primary">Editar</button>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('OS.destroy', $order->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        @endcan
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop